<?php

namespace App\Business;

use App\Business\Query\QueryTemplate;
use App\Business\Query\QueryCreator;
use App\Business\Table\Table;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Connection;

class FillDatabase
{
    /**
     * @var QueryCreator|null
     */
    private ?QueryCreator $queryCreator = null;

    /**
     * @var Connection
     */
    private Connection $connection;

    /**
     */
    public function __construct()
    {
        $this->connection = Manager::connection('filldatabase');
    }

    /**
     * @param string $table
     * @return QueryCreator
     */
    public function queryCreator(string $table): QueryCreator
    {
        if (is_null($this->queryCreator)) {
            $this->setQueryCreator($table);
        }

        return $this->queryCreator;
    }

    /**
     * @param string $tableName
     * @return void
     */
    private function setQueryCreator(string $tableName): void
    {
        $table = $this->table($tableName);

        $this->queryCreator = new QueryCreator($table);
    }

    /**
     * @param string $table
     * @return Table
     */
    private function table(string $table): Table
    {
        $configuration['table'] = $this->connection->select(
            QueryTemplate::describe($table)
        );

        $configuration['foreign'] = $this->connection->select(
            QueryTemplate::foreingKey($this->connection->getDatabaseName(), $table)
        );

        return new Table($table, $configuration);
    }
}