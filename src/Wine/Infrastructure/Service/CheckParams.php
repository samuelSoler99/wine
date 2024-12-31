<?php

namespace App\Wine\Infrastructure\Service;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

class CheckParams
{
    public function execute(array $params, $mandatoryParams): void
    {
        foreach ($mandatoryParams as $key) {
            if (!isset($params[$key])) {
                throw new InvalidArgumentException(
                    "Error in the request, $key value is missing",
                    Response::HTTP_BAD_REQUEST
                );
            }
        }
    }
}