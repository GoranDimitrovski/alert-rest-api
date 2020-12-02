<?php

namespace App\DataFixtures;

use App\Domain\Entity\SensorStatus;
use App\Domain\Enum\SensorStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SensorStatusFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach (SensorStatusEnum::getAvailableTypes() as $availableType => $type) {
            $sensorStatus = new SensorStatus();
            $sensorStatus->setName($type);
            $manager->persist($sensorStatus);
        }
        $manager->flush();
    }
}
