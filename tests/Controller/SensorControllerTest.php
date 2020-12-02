<?php


namespace App\Tests\Controller;

use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class SensorControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function addMeasurementSuccess()
    {
        $client = static::createClient();

        $sensorUUID = Uuid::uuid4()->toString();

        $client->request(
            Request::METHOD_POST,
            sprintf('/api/v1/sensors/%s/mesurements', $sensorUUID),
            [
                "co2" => 2000,
                "time" => "2019-02-01T18:55:47+00:00"
            ]
        );

        $response = $client->getResponse();

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $this->assertSame('application/json', $response->headers->get('Content-Type'));

        $this->assertNotEmpty($client->getResponse()->getContent());

        return $sensorUUID;
    }

    /**
     * @depends addMeasurementSuccess
     * @test
     */
    public function getSensorStatusSuccess(string $uuid)
    {
        $client = static::createClient();
        $client->request(
            Request::METHOD_GET,
            sprintf('/api/v1/sensors/%s', $uuid)
        );

        $response = $client->getResponse();

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $this->assertSame('application/json', $response->headers->get('Content-Type'));

        $this->assertNotEmpty($client->getResponse()->getContent());
    }
}