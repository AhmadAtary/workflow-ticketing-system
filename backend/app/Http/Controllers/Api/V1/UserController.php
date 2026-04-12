<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\RoleName;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\StoreUserRequest;
use App\Http\Requests\Api\V1\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Support\ApiResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private function normalizeRole(mixed $role): string
    {
        return $role instanceof RoleName ? $role->value : (string) $role;
    }

    public function index(Request $request): JsonResponse
    {
        $paginator = User::query()
            ->with(['team', 'roles'])
            ->when($request->string('search')->toString(), function (Builder $query, string $search): void {
                $query->where(function (Builder $builder) use ($search): void {
                    $builder
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn (Builder $query) => $query->where('status', $request->string('status')->toString()))
            ->when($request->filled('teamId'), fn (Builder $query) => $query->where('team_id', $request->string('teamId')->toString()))
            ->latest('created_at')
            ->paginate((int) $request->integer('perPage', 15));

        return ApiResponse::paginated($paginator, UserResource::collection($paginator->getCollection()));
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $payload = $request->validated();

        $user = User::query()->create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'password' => Hash::make($payload['password']),
            'team_id' => $payload['teamId'] ?? null,
            'status' => UserStatus::Active,
        ]);

        $user->syncRoles([$this->normalizeRole($payload['role'])]);

        return ApiResponse::success(
            new UserResource($user->load('team', 'roles')),
            Response::HTTP_CREATED,
        );
    }

    public function show(User $user): JsonResponse
    {
        return ApiResponse::success(new UserResource($user->load('team', 'roles')));
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $payload = $request->validated();
        $updates = [
            'name' => $payload['name'] ?? $user->name,
            'email' => $payload['email'] ?? $user->email,
            'team_id' => array_key_exists('teamId', $payload) ? $payload['teamId'] : $user->team_id,
            'status' => $payload['status'] ?? $user->status,
        ];

        if (! empty($payload['password'])) {
            $updates['password'] = Hash::make($payload['password']);
        }

        $user->update($updates);

        if (isset($payload['role'])) {
            $user->syncRoles([$this->normalizeRole($payload['role'])]);
        }

        return ApiResponse::success(new UserResource($user->fresh()->load('team', 'roles')));
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return ApiResponse::noContent();
    }
}
