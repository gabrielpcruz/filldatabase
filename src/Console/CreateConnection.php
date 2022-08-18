<?php

namespace App\Console;

use App\App;
use DI\DependencyException;
use DI\NotFoundException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\Service\Attribute\Required;

class CreateConnection extends Console
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName('filldatabase:create-connection');
        $this->setDescription('Shows example of command console output.');

        // Arguments
        $this->addArgument('driver', InputArgument::REQUIRED)
            ->addArgument('host', InputArgument::REQUIRED)
            ->addArgument('database', InputArgument::REQUIRED)
            ->addArgument('username', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws DependencyException
     * @throws NotFoundException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Criando conexao..');

        $databasePath = App::settings()->get('path.database');
        $connectionPath = $databasePath . '/connections/';

        $connectionTemplate = $this->getConnectionTemplate();

        $driver = $input->getArgument('driver');
        $host = $input->getArgument('host');
        $database = $input->getArgument('database');
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');

        $connectionTemplate = str_replace('DRIVER',$driver, $connectionTemplate);
        $connectionTemplate = str_replace('HOST',$host, $connectionTemplate);
        $connectionTemplate = str_replace('DATABASE',$database, $connectionTemplate);
        $connectionTemplate = str_replace('USERNAME',$username, $connectionTemplate);
        $connectionTemplate = str_replace('PASSWORD',$password, $connectionTemplate);

        file_put_contents($connectionPath . "/filldatabase.php", $connectionTemplate);

        $output->writeln($connectionTemplate);

        return Command::SUCCESS;
    }

    /**
     * @return string
     */
    private function getConnectionTemplate(): string
    {
        return <<<TEMPLATE
        <?php
            return [
                    'driver' => 'DRIVER',
                    'host' => 'HOST',
                    'database' => 'DATABASE',
                    'username' => 'USERNAME',
                    'password' => 'PASSWORD',
                    'charset' => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix' => '',
            ];
TEMPLATE;
    }
}