<?php

use PHPUnit\Framework\TestCase;
use App\Services\InsertService;
use GuzzleHttp\Client;

class InsertTest extends TestCase
{
    private Client $client;
    private array $correctData;

    protected function setUp(): void
    {
        $this->client = new Client(['base_uri' => 'http://172.17.0.1']);
        $this->correctData = [
            'userName' => 'username',
            'zipCode' => '29706410',
            'phoneNumber' => '27999365140',
            'email' => 'rafael@mail.com',
            'password' => 'Abc@12345',
        ];
    }

    public function testInsertByForm()
    {
        $response = $this->client->post('/', [
            'form_params' => $this->correctData,
        ]);
        $data = json_decode($response->getBody()->getContents(), true);
        $this->assertTrue($data['inserted']);
    }

    public function testInsertSuccessful()
    {
        $service = new InsertService($this->correctData);
        $this->assertTrue($service->insert());
    }

    public function testTryInsertWrongPasswordWithoutNumbers()
    {
        $wrongData = $this->correctData;
        $wrongData['password'] = 'xxxxxxxxxxxxxx';
        $service = new InsertService($wrongData);
        $this->assertFalse($service->insert());
    }

    public function testTryInsertWrongPasswordWithoutLetters()
    {
        $wrongData = $this->correctData;
        $wrongData['password'] = '123456789';
        $service = new InsertService($wrongData);
        $this->assertFalse($service->insert());
    }

    public function testTryInsertWrongEmail()
    {
        $wrongData = $this->correctData;
        $wrongData['email'] = 'rafael.com';
        $service = new InsertService($wrongData);
        $this->assertFalse($service->insert());
    }

    public function testTryInsertWrongCep()
    {
        $wrongData = $this->correctData;
        $wrongData['zipCode'] = '297064100';
        $service = new InsertService($wrongData);
        $this->assertFalse($service->insert());
    }
}