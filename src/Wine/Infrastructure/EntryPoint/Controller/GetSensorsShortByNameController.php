<?php

namespace App\Wine\Infrastructure\EntryPoint\Controller;

use App\Shared\Domain\Bus\CommandBus;
use App\Shared\Infrastructure\EntryPoint\EntryPointToJsonResponse;
use App\Wine\Application\Command\ListSensorsShortedByName;
use App\Wine\Application\Command\Login;
use App\Wine\Application\DataTransformer\SensorToArray;
use App\Wine\Infrastructure\Service\CheckParams;
use InvalidArgumentException;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class GetSensorsShortByNameController
{
    private const MANDATORY_PARAMS = [
        'password',
        'email',
    ];

    /**
     * @OA\Get(
     *     path="/sensors/shorted",
     *     summary="Obtener sensores ordenados por nombre.",
     *     description="Retorna una lista de sensores ordenados alfabéticamente por nombre.",
     *     tags={"Sensors"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de sensores ordenados por nombre.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer", example=200),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="string", example="afb59190-4deb-11ed-bdc3-0242ac120002"),
     *                     @OA\Property(property="name", type="string", example="sensor de vino blanco")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Parámetros inválidos.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Invalid parameters.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Internal server error.")
     *         )
     *     )
     * )
     */
    public function __invoke(
        Request $request,
        EntryPointToJsonResponse $response,
        CommandBus $commandBus,
        CheckParams $checkParams,
        SensorToArray $sensorToArrayTransformer
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

            $sensors = $commandBus->handle(
                new ListSensorsShortedByName()
            );

            $transformedSensors = [];
            foreach ($sensors as $sensor) {
                $transformedSensors[] = $sensorToArrayTransformer->transform($sensor);
            }

            return $response->response(
                $transformedSensors,
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