<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityLogResource;
use App\Models\User;
use App\Services\Reports\DashboardReportService;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(
        private readonly DashboardReportService $reports,
    ) {}

    public function dashboardSummary(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        return ApiResponse::success($this->reports->dashboardSummary($user));
    }

    public function taskStats(): JsonResponse
    {
        return ApiResponse::success($this->reports->taskStats());
    }

    public function teamPerformance(Request $request): JsonResponse
    {
        return ApiResponse::success($this->reports->teamPerformance($request->string('period')->toString() ?: '30d'));
    }

    public function workflowBottlenecks(): JsonResponse
    {
        return ApiResponse::success($this->reports->workflowBottlenecks());
    }

    public function activityFeed(Request $request): JsonResponse
    {
        $paginator = $this->reports->activityFeed((int) $request->integer('perPage', 20));

        return ApiResponse::paginated($paginator, ActivityLogResource::collection($paginator->items()));
    }
}
