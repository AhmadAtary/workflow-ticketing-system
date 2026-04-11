<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Models\User;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        $paginator = $user->notifications()
            ->with('task')
            ->when($request->filled('isRead'), function ($query) use ($request): void {
                if ($request->boolean('isRead')) {
                    $query->whereNotNull('read_at');
                } else {
                    $query->whereNull('read_at');
                }
            })
            ->latest('created_at')
            ->paginate((int) $request->integer('perPage', 20));

        return ApiResponse::paginated($paginator, NotificationResource::collection($paginator->getCollection()));
    }

    public function markRead(Request $request, Notification $notification): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();
        abort_unless($notification->user_id === $user->id, 404);

        $notification->forceFill([
            'read_at' => $notification->read_at ?? now(),
        ])->save();

        return ApiResponse::success(new NotificationResource($notification->fresh('task')));
    }

    public function markAllRead(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        $user->notifications()
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return ApiResponse::success([
            'message' => 'Notifications marked as read.',
        ]);
    }
}
