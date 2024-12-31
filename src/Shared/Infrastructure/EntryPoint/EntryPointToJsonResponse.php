<?php

namespace App\Shared\Infrastructure\EntryPoint;

use Symfony\Component\HttpFoundation\JsonResponse;

class EntryPointToJsonResponse
{
    public function response(array $entity, int $code): JsonResponse
    {
        return new JsonResponse(
            [
                'status' => $code,
                'data' => $entity
            ],
            $code
        );
    }

    public function error(string $data, int $code): JsonResponse
    {
        $jsonResponse = [
            'detail' => $data,
            'status' => $code,
        ];
        return new JsonResponse($jsonResponse, $code);
    }
}