<?php

namespace App\Http\Api;

use App\Http\ControllerApi;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

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
        $application = getConsole($this->container);
        $application->setAutoExit(false);

        $arguments = json_decode($request->getBody()->getContents());

        $input = new ArrayInput([
            'command' => 'filldatabase:create-connection',
            'driver' => $arguments->driver,
            'host' => $arguments->host,
            'database' => $arguments->database,
            'username' => $arguments->username,
            'password' => $arguments->password
        ]);

        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);

        // return the output, don't use if you used NullOutput()
        $content = $output->fetch();

        return $this->responseJSON(
            $response,
            [
                'message' => $content
            ]
        );
    }
}