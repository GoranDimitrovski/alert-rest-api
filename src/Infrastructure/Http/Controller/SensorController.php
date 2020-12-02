<?php

namespace App\Infrastructure\Http\Controller;

use App\Application\DTO\AlertDTO;
use App\Application\Service\SensorService;
use DateTime;
use Doctrine\ORM\EntityNotFoundException;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * Class SensorController
 * @package App\Infrastructure\Http\Rest\Controller
 * @Route(path="/sensors")
 */
final class SensorController
{
    /** @var SensorService */
    private $sensorService;

    /** @var LoggerInterface */
    private $logger;

    /**
     * SensorController constructor.
     *
     * @param SensorService $sensorService
     * @param LoggerInterface $logger
     */
    public function __construct(SensorService $sensorService, LoggerInterface $logger)
    {
        $this->sensorService = $sensorService;
        $this->logger = $logger;
    }

    /**
     * Retrieves a collection of Alerts resource
     * @Route("/{uuid}", name="get_sensor_status", methods={"GET"})
     *
     * @param string $uuid
     *
     * @return JsonResponse
     */
    public function getSensorStatus(string $uuid): JsonResponse
    {
        if (!UUID::isValid($uuid)) {
            return new JsonResponse(['error' => 'Invalid UUID!'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        try {
            $sensorStatusDTO = $this->sensorService->getSensorStatusByUUID(Uuid::fromString($uuid));

            return new JsonResponse(($sensorStatusDTO)->toArray(), Response::HTTP_OK);
        } catch (EntityNotFoundException $e) {
            return new JsonResponse(
                ['error' => sprintf('Sensor with the UUID %s does not exist', $uuid)],
                Response::HTTP_NOT_FOUND
            );
        } catch (Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Retrieves a collection of Alerts resource
     * @Route("/{uuid}/alerts", name="get_all_alerts", methods={"GET"})
     *
     * @param string $uuid
     *
     * @return JsonResponse
     */
    public function getAlerts(string $uuid): JsonResponse
    {
        if (!UUID::isValid($uuid)) {
            return new JsonResponse(['error' => 'Invalid UUID!'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $alertDTOs = $this->sensorService->getAlerts(Uuid::fromString($uuid));

        return new JsonResponse(
            array_map(
                function (AlertDTO $alertDTO) {
                    return $alertDTO->toArray();
                },
                $alertDTOs
            ), Response::HTTP_OK
        );
    }

    /**
     * Add a new measurement
     * @Route("/{uuid}/mesurements", name="add_measurement", methods={"POST"})
     *
     * @param Request $request
     * @param string $uuid
     *
     * @return JsonResponse
     */
    public function addMeasurement(Request $request, string $uuid): JsonResponse
    {
        if (!UUID::isValid($uuid)) {
            return new JsonResponse(['error' => 'Invalid UUID!'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $level = $request->get('co2');
        $time = $request->get('time');

        try {
            $measurementDTO = $this->sensorService->addMeasurement(
                Uuid::fromString($uuid),
                $level,
                new DateTime($time)
            );

            return new JsonResponse($measurementDTO->toArray(), Response::HTTP_OK);
        } catch (Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Get sensor metrics
     * @Route("/{uuid}/metrics", name="get_sensor_metrics", methods={"GET"})
     *
     * @param string $uuid
     *
     * @return JsonResponse
     */
    public function getSensorMetrics(string $uuid): JsonResponse
    {
        if (!UUID::isValid($uuid)) {
            return new JsonResponse(['error' => 'Invalid UUID!'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        try {
            $metricDTO = $this->sensorService->getSensorMetricsDTO(Uuid::fromString($uuid));
            return new JsonResponse($metricDTO->toArray(), Response::HTTP_OK);
        } catch (Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param Throwable $e
     *
     * @return JsonResponse
     */
    private function errorResponse(Throwable $e)
    {
        $this->logger->error('message', ['exception' => $e]);
        return new JsonResponse(
            ['error' => 'Unexpected error'],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
