<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Team\StoreTeamRequest;
use App\Http\Requests\Api\V1\Team\UpdateTeamRequest;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use App\Support\ApiResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $paginator = Team::query()
            ->withCount(['users', 'tasks'])
            ->when($request->string('search')->toString(), function (Builder $query, string $search): void {
                $query->where(function (Builder $builder) use ($search): void {
                    $builder
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate((int) $request->integer('perPage', 15));

        return ApiResponse::paginated($paginator, TeamResource::collection($paginator->getCollection()));
    }

    public function store(StoreTeamRequest $request): JsonResponse
    {
        $team = Team::query()->create($request->validated());

        return ApiResponse::success(
            new TeamResource($team->loadCount(['users', 'tasks'])),
            Response::HTTP_CREATED,
        );
    }

    public function show(Team $team): JsonResponse
    {
        return ApiResponse::success(new TeamResource($team->loadCount(['users', 'tasks'])));
    }

    public function update(UpdateTeamRequest $request, Team $team): JsonResponse
    {
        $team->update($request->validated());

        return ApiResponse::success(new TeamResource($team->fresh()->loadCount(['users', 'tasks'])));
    }

    public function destroy(Team $team): JsonResponse
    {
        $team->delete();

        return ApiResponse::noContent();
    }
}
