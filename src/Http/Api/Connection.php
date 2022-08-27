<?php

namespace App\Http\Api;

use App\Http\ControllerApi;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Connection extends ControllerApi
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws Exception
     */
    public function create(Request $request, Response $response): Response
    {
        $arguments = (object) $request->getParsedBody();

        $command = [
            'command' => 'filldatabase:create-connection',
            'driver' => $arguments->driver,
            'host' => $arguments->host,
            'database' => $arguments->database,
            'username' => $arguments->username,
            'password' => $arguments->password
        ];

        return $this->responseJSON(
            $response,
            [
                'message' => command($command)
            ]
        );
    }
}