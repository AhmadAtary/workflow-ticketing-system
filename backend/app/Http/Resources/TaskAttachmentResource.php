<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TaskAttachmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'taskId' => $this->task_id,
            'fileName' => $this->original_name,
            'fileSize' => $this->size,
            'fileType' => $this->mime_type,
            'url' => Storage::disk($this->disk)->url($this->path),
            'uploadedByName' => $this->uploadedBy?->name,
            'createdAt' => $this->created_at?->toIso8601String(),
        ];
    }
}
