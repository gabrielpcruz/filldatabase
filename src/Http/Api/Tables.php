<?php

namespace App\Http\Api;

use App\Http\ControllerApi;
use Illuminate\Database\Capsule\Manager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Tables extends ControllerApi
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function tables(Request $request, Response $response): Response
    {
        $connection = Manager::connection('filldatabase');

        $tables = $connection->select("show full tables where Table_Type != 'VIEW'");

        return $this->responseJSON($response, $this->tratarTables($tables));
    }

    /**
     * @param $tablesQuery
     * @return array
     */
    private function tratarTables($tablesQuery): array
    {
        $tables = [];

        foreach ($tablesQuery as $table) {
            $key = array_keys((array) $table);

            $key = reset($key);

            $tables[] = $table->{$key};
        }

        return $tables;
    }
}