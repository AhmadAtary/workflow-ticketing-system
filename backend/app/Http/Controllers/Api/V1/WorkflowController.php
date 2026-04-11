<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\TaskStatus;
use App\Enums\WorkflowStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Workflow\StoreWorkflowRequest;
use App\Http\Requests\Api\V1\Workflow\UpdateWorkflowRequest;
use App\Http\Resources\WorkflowResource;
use App\Models\Workflow;
use App\Models\WorkflowStep;
use App\Support\ApiResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class WorkflowController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $paginator = Workflow::query()
            ->with(['steps.team'])
            ->withCount('tasks')
            ->when($request->string('search')->toString(), function (Builder $query, string $search): void {
                $query->where(function (Builder $builder) use ($search): void {
                    $builder
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn (Builder $query) => $query->where('status', $request->string('status')->toString()))
            ->orderBy('name')
            ->paginate((int) $request->integer('perPage', 15));

        return ApiResponse::paginated($paginator, WorkflowResource::collection($paginator->getCollection()));
    }

    public function store(StoreWorkflowRequest $request): JsonResponse
    {
        $workflow = DB::transaction(function () use ($request): Workflow {
            $payload = $request->validated();

            $workflow = Workflow::query()->create([
                'name' => $payload['name'],
                'description' => $payload['description'] ?? null,
                'status' => $payload['status'] ?? WorkflowStatus::Active,
            ]);

            $this->syncSteps($workflow, collect($payload['steps']));

            return $workflow->fresh(['steps.team'])->loadCount('tasks');
        });

        return ApiResponse::success(new WorkflowResource($workflow), Response::HTTP_CREATED);
    }

    public function show(Workflow $workflow): JsonResponse
    {
        return ApiResponse::success(new WorkflowResource($workflow->load(['steps.team'])->loadCount('tasks')));
    }

    public function update(UpdateWorkflowRequest $request, Workflow $workflow): JsonResponse
    {
        $workflow = DB::transaction(function () use ($request, $workflow): Workflow {
            $payload = $request->validated();

            $workflow->update([
                'name' => $payload['name'] ?? $workflow->name,
                'description' => array_key_exists('description', $payload) ? $payload['description'] : $workflow->description,
                'status' => $payload['status'] ?? $workflow->status,
            ]);

            if (isset($payload['steps'])) {
                $this->syncSteps($workflow, collect($payload['steps']));
            }

            return $workflow->fresh(['steps.team'])->loadCount('tasks');
        });

        return ApiResponse::success(new WorkflowResource($workflow));
    }

    public function destroy(Workflow $workflow): JsonResponse
    {
        $workflow->delete();

        return ApiResponse::noContent();
    }

    private function syncSteps(Workflow $workflow, Collection $steps): void
    {
        $existingSteps = $workflow->steps()->get()->keyBy('id');
        $stepIdsToKeep = $steps->pluck('id')->filter()->values();

        $stepIdsToDelete = $existingSteps->keys()->diff($stepIdsToKeep)->values();

        if ($stepIdsToDelete->isNotEmpty()) {
            $hasLiveTasks = $workflow->tasks()
                ->whereIn('current_workflow_step_id', $stepIdsToDelete)
                ->whereNotIn('status', [TaskStatus::Completed->value, TaskStatus::Closed->value])
                ->exists();

            if ($hasLiveTasks) {
                throw ValidationException::withMessages([
                    'steps' => ['Cannot remove workflow steps that are currently assigned to active tasks.'],
                ]);
            }

            WorkflowStep::query()
                ->where('workflow_id', $workflow->id)
                ->whereIn('id', $stepIdsToDelete)
                ->delete();
        }

        $steps->values()->each(function (array $step, int $index) use ($workflow, $existingSteps): void {
            /** @var WorkflowStep|null $model */
            $model = isset($step['id']) ? $existingSteps->get($step['id']) : new WorkflowStep;

            $model ??= new WorkflowStep;

            $model->fill([
                'workflow_id' => $workflow->id,
                'name' => $step['name'],
                'description' => $step['description'] ?? null,
                'sequence' => $index + 1,
                'team_id' => $step['teamId'] ?? null,
                'step_type' => $step['stepType'],
                'is_required' => (bool) ($step['required'] ?? true),
            ]);

            $model->workflow()->associate($workflow);
            $model->save();
        });
    }
}
