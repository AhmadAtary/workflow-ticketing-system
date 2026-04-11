<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Team;
use App\Models\User;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamMemberController extends Controller
{
    public function index(Request $request, Team $team): JsonResponse
    {
        $paginator = $team->users()
            ->with(['team', 'roles'])
            ->orderBy('name')
            ->paginate((int) $request->integer('perPage', 15));

        return ApiResponse::paginated($paginator, UserResource::collection($paginator->getCollection()));
    }

    public function store(Request $request, Team $team): JsonResponse
    {
        $payload = $request->validate([
            'userId' => ['required', 'exists:users,id'],
        ]);

        $user = User::query()->findOrFail($payload['userId']);
        $user->forceFill(['team_id' => $team->id])->save();

        return ApiResponse::success(
            new UserResource($user->fresh()->load(['team', 'roles'])),
            Response::HTTP_CREATED,
        );
    }

    public function destroy(Team $team, User $user): JsonResponse
    {
        if ($user->team_id === $team->id) {
            $user->forceFill(['team_id' => null])->save();
        }

        return ApiResponse::noContent();
    }
}
