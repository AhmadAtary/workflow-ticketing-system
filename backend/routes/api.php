<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\EmailTemplateController;
use App\Http\Controllers\Api\V1\HealthController;
use App\Http\Controllers\Api\V1\NotificationController;
use App\Http\Controllers\Api\V1\ReportController;
use App\Http\Controllers\Api\V1\SystemSettingController;
use App\Http\Controllers\Api\V1\TaskAttachmentController;
use App\Http\Controllers\Api\V1\TaskCommentController;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\V1\TaskLifecycleController;
use App\Http\Controllers\Api\V1\TeamController;
use App\Http\Controllers\Api\V1\TeamMemberController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\WorkflowController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::get('/healthz', HealthController::class);

    Route::prefix('auth')->group(function (): void {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/refresh', [AuthController::class, 'refresh']);

        Route::middleware('auth:api')->group(function (): void {
            Route::get('/me', [AuthController::class, 'me']);
            Route::post('/logout', [AuthController::class, 'logout']);
        });
    });

    Route::middleware('auth:api')->group(function (): void {
        Route::get('/tasks', [TaskController::class, 'index']);
        Route::get('/tasks/{task}', [TaskController::class, 'show']);
        Route::get('/tasks/{task}/comments', [TaskCommentController::class, 'index']);
        Route::post('/tasks/{task}/comments', [TaskCommentController::class, 'store']);
        Route::post('/tasks/{task}/complete-step', [TaskLifecycleController::class, 'completeStep']);
        Route::post('/tasks/{task}/send-back', [TaskLifecycleController::class, 'sendBack']);
        Route::post('/tasks/{task}/hold', [TaskLifecycleController::class, 'hold']);
        Route::post('/tasks/{task}/close', [TaskLifecycleController::class, 'close']);
        Route::post('/tasks/{task}/attachments', [TaskAttachmentController::class, 'store']);
        Route::delete('/tasks/{task}/attachments/{attachment}', [TaskAttachmentController::class, 'destroy']);

        Route::get('/notifications', [NotificationController::class, 'index']);
        Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllRead']);
        Route::post('/notifications/{notification}/read', [NotificationController::class, 'markRead']);

        Route::get('/reports/dashboard-summary', [ReportController::class, 'dashboardSummary']);
    });

    Route::middleware(['auth:api', 'role:admin'])->group(function (): void {
        Route::apiResource('users', UserController::class);
        Route::apiResource('teams', TeamController::class);
        Route::get('/teams/{team}/members', [TeamMemberController::class, 'index']);
        Route::post('/teams/{team}/members', [TeamMemberController::class, 'store']);
        Route::delete('/teams/{team}/members/{user}', [TeamMemberController::class, 'destroy']);

        Route::apiResource('workflows', WorkflowController::class);
        Route::apiResource('tasks', TaskController::class)->except(['index', 'show']);
        Route::apiResource('email-templates', EmailTemplateController::class);

        Route::get('/reports/task-stats', [ReportController::class, 'taskStats']);
        Route::get('/reports/team-performance', [ReportController::class, 'teamPerformance']);
        Route::get('/reports/workflow-bottlenecks', [ReportController::class, 'workflowBottlenecks']);
        Route::get('/reports/activity-feed', [ReportController::class, 'activityFeed']);

        Route::get('/settings', [SystemSettingController::class, 'show']);
        Route::put('/settings', [SystemSettingController::class, 'update']);
    });
});
