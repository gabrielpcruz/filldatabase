<?php

namespace App\Http\Api;

use App\Http\ControllerApi;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Business\FillDatabase;
use Illuminate\Database\Capsule\Manager;

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
            ->insert()
            ->build();

//        foreach (explode(";", $query) as $partial) {
//            Manager::connection('filldatabase')->insert($partial);
//        }

        return $this->responseJSON(
            $response,
            [ 'query' => $query ]
        );
    }
}