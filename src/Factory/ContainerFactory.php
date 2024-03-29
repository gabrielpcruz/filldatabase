<?php

namespace App\Factory;

use DI\ContainerBuilder;
use DI\Container;
use Exception;
use Slim\Flash\Messages;

final class ContainerFactory
{
    /**
     * @return Container
     * @throws Exception
     */
    public function create(): Container
    {
        $containerBuilder = new ContainerBuilder();

        $containerBuilder->addDefinitions(__DIR__ . '/../../config/container.php');

        $containerBuilder->addDefinitions([
            'flash' => function () {
                return new Messages($_SESSION);
            }
        ]);

        return $containerBuilder->build();
    }
}