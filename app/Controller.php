<?php

namespace App;

use App\Services\InsertService;
use App\Services\SelectService;
use PlugRoute\Http\Response;

class Controller
{
    private Response $response;

    public function __construct()
    {
        $this->response = new Response();
    }

    public function index()
    {
        readfile('../src/form.html');
    }

    public function insert()
    {
        $service = new InsertService($_POST);
        return $this->response
            ->setHeaders(['Content-Type' => 'application/json'])
            ->json(['inserted' => $service->insert()]);
    }

    public function select($informacao)
    {
        $service = new SelectService();
        return $this->response
            ->setHeaders(['Content-Type' => 'application/json'])
            ->json(['selected' => $service->select($informacao)]);
    }
}