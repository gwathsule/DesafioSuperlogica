<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use App\Services\SelectService;

class SelectTest extends TestCase
{
    private Client $client;

    protected function setUp(): void
    {
        $this->client = new Client(['base_uri' => 'http://172.17.0.1']);
    }

    public function testSelectByApi()
    {
        $response = $this->client->get('/select/userName');
        $data = json_decode($response->getBody()->getContents(), true);
        $this->assertTrue($data['selected']);
    }

    public function testSelectSuccessful()
    {
        $service = new SelectService();
        $this->assertTrue($service->select('userName'));
        $this->assertTrue($service->select('zipCode'));
        $this->assertTrue($service->select('phoneNumber'));
        $this->assertTrue($service->select('email'));
    }

    public function testTrySelectWithWrongInfo()
    {
        $service = new SelectService();
        $this->assertFalse($service->select('wrong'));
    }
}