<?php

namespace App\Wine\Infrastructure\EntryPoint\Controller;

use App\Shared\Domain\Bus\CommandBus;
use App\Shared\Infrastructure\EntryPoint\EntryPointToJsonResponse;
use App\Wine\Application\Command\CreateMeasurement;
use App\Wine\Application\Command\Login;
use App\Wine\Domain\Exception\SensorNotFound;
use App\Wine\Domain\Exception\WineNotFound;
use App\Wine\Infrastructure\Service\CheckParams;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class PostMeasurementController
{
    private const MANDATORY_PARAMS = [
        'password',
        'email',
        'idSensor',
        'idWine',
        'color',
        'year',
        'temperature',
        'graduation',
        'pH'
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
                new CreateMeasurement(
                    $params['idSensor'],
                    $params['idWine'],
                    $params['color'],
                    $params['year'],
                    $params['temperature'],
                    $params['graduation'],
                    $params['pH']
                )
            );

            return $response->response(
                ['success' => true],
                200
            );
        } catch (SensorNotFound $e) {
            return $response->error('received idSensor, does not exist', $e->getCode());
        } catch (WineNotFound $e) {
            return $response->error('received IdWine, does not exist', $e->getCode());
        } catch (InvalidArgumentException $e) {
            return $response->error($e->getMessage(), $e->getCode());
        } catch (Throwable $e) {
            return $response->error(
                'Internal server error. We\'re working to fix it. Please try again later ',
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}