<?php

namespace App\Support;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProblemResponse
{
    public static function make(
        Request $request,
        int $status,
        string $title,
        ?string $detail = null,
        array $errors = [],
        string $type = 'about:blank',
    ): JsonResponse {
        return response()->json(array_filter([
            'type' => $type,
            'title' => $title,
            'status' => $status,
            'detail' => $detail,
            'instance' => $request->path(),
            'trace_id' => $request->attributes->get('request_id'),
            'errors' => $errors === [] ? null : $errors,
        ], static fn (mixed $value): bool => $value !== null), $status, [
            'Content-Type' => 'application/problem+json',
        ]);
    }

    public static function validation(Request $request, array $errors): JsonResponse
    {
        return self::make(
            $request,
            422,
            'Validation failed',
            'One or more fields failed validation.',
            $errors,
            'https://httpstatuses.com/422',
        );
    }
}
