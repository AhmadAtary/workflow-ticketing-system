<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\EmailTemplate\StoreEmailTemplateRequest;
use App\Http\Requests\Api\V1\EmailTemplate\UpdateEmailTemplateRequest;
use App\Http\Resources\EmailTemplateResource;
use App\Models\EmailTemplate;
use App\Support\ApiResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmailTemplateController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $paginator = EmailTemplate::query()
            ->when($request->string('search')->toString(), function (Builder $query, string $search): void {
                $query->where(function (Builder $builder) use ($search): void {
                    $builder
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('subject', 'like', "%{$search}%")
                        ->orWhere('body', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('trigger'), fn (Builder $query) => $query->where('trigger', $request->string('trigger')->toString()))
            ->when($request->filled('isActive'), fn (Builder $query) => $query->where('is_active', $request->boolean('isActive')))
            ->latest('created_at')
            ->paginate((int) $request->integer('perPage', 15));

        return ApiResponse::paginated($paginator, EmailTemplateResource::collection($paginator->getCollection()));
    }

    public function store(StoreEmailTemplateRequest $request): JsonResponse
    {
        $payload = $request->validated();

        $template = EmailTemplate::query()->create([
            'name' => $payload['name'],
            'subject' => $payload['subject'],
            'body' => $payload['body'],
            'trigger' => $payload['trigger'],
            'variables' => $payload['variables'] ?? [],
            'is_active' => (bool) ($payload['isActive'] ?? true),
        ]);

        return ApiResponse::success(new EmailTemplateResource($template), Response::HTTP_CREATED);
    }

    public function show(EmailTemplate $emailTemplate): JsonResponse
    {
        return ApiResponse::success(new EmailTemplateResource($emailTemplate));
    }

    public function update(UpdateEmailTemplateRequest $request, EmailTemplate $emailTemplate): JsonResponse
    {
        $payload = $request->validated();

        $emailTemplate->update([
            'name' => $payload['name'] ?? $emailTemplate->name,
            'subject' => $payload['subject'] ?? $emailTemplate->subject,
            'body' => $payload['body'] ?? $emailTemplate->body,
            'trigger' => $payload['trigger'] ?? $emailTemplate->trigger,
            'variables' => array_key_exists('variables', $payload) ? $payload['variables'] : $emailTemplate->variables,
            'is_active' => array_key_exists('isActive', $payload) ? (bool) $payload['isActive'] : $emailTemplate->is_active,
        ]);

        return ApiResponse::success(new EmailTemplateResource($emailTemplate->fresh()));
    }

    public function destroy(EmailTemplate $emailTemplate): JsonResponse
    {
        $emailTemplate->delete();

        return ApiResponse::noContent();
    }
}
