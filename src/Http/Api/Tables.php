<?php

namespace App\Http\Api;

use App\Http\ControllerApi;
use Illuminate\Database\Capsule\Manager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Tables extends ControllerApi
{
    public function tables(Request $request, Response $response): Response
    {
        $connection = Manager::connection('filldatabase');

        $tables = $connection->query()->select('SHOW TABLES')->get();

        return $this->responseJSON($response, $tables->toArray(), 200);
    }
}