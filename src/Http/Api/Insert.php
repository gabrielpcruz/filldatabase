<?php

namespace App\Http\Api;

use App\Http\ControllerApi;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Business\FillDatabase;

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

        $query = (new FillDatabase())
            ->queryCreator($table)
            ->update(1)
            ->build();

        return $this->responseJSON(
            $response,
            [
                'query' => $query
            ]
        );
    }
}