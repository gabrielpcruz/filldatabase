<?php

namespace App\Http\Api;

use App\Business\Query\QueryCreator;
use App\Http\ControllerApi;
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

        $table = $arguments->table;
        $connection = Manager::connection('filldatabase');
        $tableDetails = $connection->select("DESCRIBE $table");

        $query = (new QueryCreator($table, $tableDetails))
            ->insert()
            ->build();

        return $this->responseJSON(
            $response,
            [
                'query' => $query
            ]
        );
    }
}