<?php

namespace App\Application\Service;

use App\Application\DTO\AlertDTO;
use App\Application\DTO\MeasurementDTO;
use App\Application\DTO\MetricDTO;
use App\Application\DTO\StatusDTO;
use App\Domain\Entity\Alert;
use App\Domain\Entity\Measurement;
use App\Domain\Entity\Sensor;
use App\Domain\Enum\SensorStatusEnum;
use App\Domain\Interfaces\AlertRepositoryInterface;
use App\Domain\Interfaces\MeasurementRepositoryInterface;
use App\Domain\Interfaces\SensorRepositoryInterface;
use App\Domain\Interfaces\SensorStatusRepositoryInterface;
use DateTime;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\NonUniqueResultException;
use Ramsey\Uuid\UuidInterface;

/**
 * Class SensorService
 * @package App\Application\Service
 */
class SensorService
{
    /** @var SensorRepositoryInterface */
    private $sensorRepository;

    /** @var AlertRepositoryInterface */
    private $alertRepository;

    /** @var MeasurementRepositoryInterface */
    private $measurementRepository;

    /** @var SensorStatusRepositoryInterface */
    private $sensorStatusRepository;

    /**
     * SensorService constructor.
     *
     * @param SensorRepositoryInterface $sensorRepository
     * @param AlertRepositoryInterface $alertRepository
     * @param MeasurementRepositoryInterface $measurementRepository
     * @param SensorStatusRepositoryInterface $sensorStatusRepository
     */
    public function __construct(
        SensorRepositoryInterface $sensorRepository,
        AlertRepositoryInterface $alertRepository,
        MeasurementRepositoryInterface $measurementRepository,
        SensorStatusRepositoryInterface $sensorStatusRepository
    ) {
        $this->sensorRepository = $sensorRepository;
        $this->alertRepository = $alertRepository;
        $this->measurementRepository = $measurementRepository;
        $this->sensorStatusRepository = $sensorStatusRepository;
    }

    /**
     * @param UuidInterface $sensorId
     * @return array
     */
    public function getAlerts(UuidInterface $sensorId): array
    {
        $alerts = $this->alertRepository->findAllByUUID($sensorId);
        $alertDTOs = [];

        /** @var Alert $alert */
        foreach ($alerts as $alert) {
            $alertDTOs[] = new AlertDTO(
                $alert->getStartTime(),
                $alert->getEndTime(),
                $alert->getMeasurement1(),
                $alert->getMeasurement2(),
                $alert->getMeasurement3()
            );
        }

        return $alertDTOs;
    }

    /**
     * @param UuidInterface $sensorId
     *
     * @return StatusDTO
     *
     * @throws EntityNotFoundException|NonUniqueResultException
     */
    public function getSensorStatusByUUID(UuidInterface $sensorId): StatusDTO
    {
        $sensor = $this->sensorRepository->findByUUID($sensorId);
        if (!$sensor) {
            throw new EntityNotFoundException(sprintf('Sensor with id %s does not exist!', $sensorId));
        }

        return new StatusDTO($sensor->getStatus()->getName());
    }

    /**
     * @param UuidInterface $uuid
     * @param int $level
     * @param DateTime $time
     *
     * @return MeasurementDTO
     *
     * @throws NonUniqueResultException
     */
    public function addMeasurement(UuidInterface $uuid, int $level, DateTime $time): MeasurementDTO
    {
        $sensor = $this->sensorRepository->findByUUID($uuid);

        if (null === $sensor) {
            $sensor = $this->addSensor($uuid);
        }

        $measurement = new Measurement();
        $measurement->setLevel($level)
            ->setCreatedAt($time)
            ->setSensor($sensor);

        $measurement = $this->measurementRepository->save($measurement);

        return new MeasurementDTO(
            $measurement->getLevel(),
            $measurement->getCreatedAt()
        );
    }

    /**
     * @param UuidInterface $uuid
     *
     * @return Sensor
     *
     * @throws NonUniqueResultException
     */
    public function addSensor(UuidInterface $uuid): Sensor
    {
        $sensorStatus = $this->sensorStatusRepository->findByName(SensorStatusEnum::OK);

        $sensor = new Sensor();
        $sensor->setCreatedAt(new DateTime())
            ->setUuid($uuid)
            ->setStatus($sensorStatus);

        $this->sensorRepository->save($sensor);

        return $sensor;
    }

    /**
     * @param UuidInterface $uuid
     * @return MetricDTO
     */
    public function getSensorMetricsDTO(UuidInterface $uuid): MetricDTO
    {
        $maxLast30Days = $this->measurementRepository->getMaxLastMonth($uuid);
        $avgLast30Days = $this->measurementRepository->getAvgLastMonth($uuid);

        return new MetricDTO($maxLast30Days, $avgLast30Days);
    }
}
