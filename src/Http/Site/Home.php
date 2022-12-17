<?php

namespace App\Http\Site;

use App\App;
use App\Business\Rice\RiceBusiness;
use App\Http\SiteController;
use DI\DependencyException;
use DI\NotFoundException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Home extends SiteController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws DependencyException
     * @throws NotFoundException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(Request $request, Response $response): Response
    {
        $rices = [];

        $path = App::settings()->get('path.database') . '/connections/filldatabase.php';

        $config = (object) (require $path);

        return $this->view(
            $response,
            "@site/home/index",
            compact('rices', 'config')
        );
    }
}