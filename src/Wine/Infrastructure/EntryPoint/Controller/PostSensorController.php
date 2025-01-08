<?php

namespace App\Wine\Infrastructure\EntryPoint\Controller;

use App\Shared\Domain\Bus\CommandBus;
use App\Shared\Infrastructure\EntryPoint\EntryPointToJsonResponse;
use App\Wine\Application\Command\CreateSensor;
use App\Wine\Application\Command\Login;
use App\Wine\Domain\Exception\SensorAlreadyExists;
use App\Wine\Infrastructure\Service\CheckParams;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class PostSensorController
{
    private const MANDATORY_PARAMS = [
        'password',
        'email',
        'sensorName'
    ];

    public function __invoke(
        Request $request,
        EntryPointToJsonResponse $response,
        CommandBus $commandBus,
        CheckParams $checkParams,
    ): JsonResponse {
        try {
            $params = json_decode($request->getContent(), true);

            $checkParams->execute($params ?? [], self::MANDATORY_PARAMS);

            $loginValidation = $commandBus->handle(
                new Login($params['email'], $params['password'])
            );

            if (!$loginValidation) {
                return $response->response(
                    [
                        'success' => false,
                        'message' => 'Login validation failed'
                    ],
                    200
                );
            }

            $commandBus->handle(
                new CreateSensor($params['sensorName'])
            );

            return $response->response(
                ['success' => true],
                200
            );
        } catch (InvalidArgumentException|SensorAlreadyExists $e) {
            return $response->error($e->getMessage(), $e->getCode());
        } catch (Throwable $e) {
            return $response->error(
                'Internal server error. We\'re working to fix it. Please try again later ',
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}