<?php

namespace App\Business\Query;

use App\Business\FillDatabase;
use App\Business\Table\Table;

class QueryCreator
{
    /**
     * @var string
     */
    private string $temporaryQuery = "";

    /**
     * @var Table
     */
    private Table $table;

    /**
     * @param Table $table
     */
    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    /**
     * @return QueryCreator
     */
    public function insert(): QueryCreator
    {
        if ($this->table->hasForeignKey()) {
            $foreignsQuery = "";

            foreach ($this->table->foreigns() as $foreign) {
                $foreingName = $foreign->tableForeing();
                $query = (new FillDatabase())->queryCreator($foreingName)->insert()->build();
                $foreignsQuery .= $query . " ; " . PHP_EOL . PHP_EOL;
            }

            $this->temporaryQuery = $foreignsQuery . PHP_EOL;
        }

        $insert = new Insert($this->table);
        $this->temporaryQuery .= $insert->build();

        return $this;
    }

    /**
     * @param $id
     * @return QueryCreator
     */
    public function update($id): QueryCreator
    {
        $update = new Update($this->table, $id);
        $this->temporaryQuery = $update->build();

        return $this;
    }

    /**
     * @return string
     */
    public function build(): string
    {
        $query = $this->temporaryQuery;

        $this->temporaryQuery = "";

        return $query;
    }
}