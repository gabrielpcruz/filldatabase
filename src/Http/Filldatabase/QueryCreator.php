<?php

namespace App\Http\Filldatabase;

class QueryCreator
{
    /**
     * @var string
     */
    private string $temporaryQuery;

    /**
     * @var array
     */
    private array $describe;

    /**
     * @var string
     */
    private string $table;

    /**
     * @param string $table
     * @param array $describe
     */
    public function __construct(string $table, array $describe)
    {
        $this->table = $table;
        $this->describe = $describe;
    }

    /**
     * @return QueryCreator
     */
    public function insert(): QueryCreator
    {
        $insert = new Insert($this->table, $this->describe);
        $this->temporaryQuery = $insert->build();

        return $this;
    }

    /**
     * @param $id
     * @return QueryCreator
     */
    public function update($id): QueryCreator
    {
        $update = new Update($this->table, $this->describe, $id);
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