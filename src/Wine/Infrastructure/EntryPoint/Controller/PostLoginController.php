<?php

namespace App\Wine\Infrastructure\EntryPoint\Controller;

use App\Shared\Domain\Bus\CommandBus;
use App\Shared\Infrastructure\EntryPoint\EntryPointToJsonResponse;
use App\Wine\Application\Command\Login;
use App\Wine\Infrastructure\Service\CheckParams;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class PostLoginController
{
    private const MANDATORY_PARAMS = [
        'password',
        'email'
    ];

    /**
     * TODO se deberia de generar un token JWT con un ttl en la respuesta y un midelware para que verificara los otros controllers
     */
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
                    ['success' => false],
                    200
                );
            }

            return $response->response(
                ['success' => true],
                200
            );
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