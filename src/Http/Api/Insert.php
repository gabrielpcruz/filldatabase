<?php

namespace App\Http\Api;

use App\Business\Query\QueryCreator;
use App\Business\Table\Table;
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
        $configs = [];
        $database = $connection->getDatabaseName();
        $configs['table'] = $connection->select("DESCRIBE $table");

        $sql = "SELECT TABLE_NAME, COLUMN_NAME, CONSTRAINT_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_SCHEMA = '$database' AND TABLE_NAME = '$table'";

        $configs['foreign'] = $connection->select($sql);

        $table = new Table($table, $configs);
        $query = (new QueryCreator($table))
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