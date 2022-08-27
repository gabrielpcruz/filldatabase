<?php

namespace App\Http\Api;

use App\Http\ControllerApi;
use App\Http\Filldatabase\QueryCreator;
use Illuminate\Database\Capsule\Manager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Insert extends ControllerApi
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function insert(Request $request, Response $response): Response
    {
        $arguments = (object) $request->getParsedBody();

        $tableName = $arguments->table;

        $connection = Manager::connection('filldatabase');

        $tableDetails = $connection->select("DESCRIBE $tableName");

        $queryCreator = new QueryCreator($tableName);
        $query = $queryCreator
            ->addTableDescribe($tableDetails)
            ->insert();

        $connection->insert($query);
        return $this->responseJSON(
            $response,
            [
                'query' => $query
            ]
        );
    }
}