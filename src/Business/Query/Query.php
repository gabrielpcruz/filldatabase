<?php

namespace App\Business\Query;

use App\Business\Data\DataGenerator;
use App\Business\Table\Column;
use Generator;

abstract class Query
{
    /**
     * @var string
     */
    protected string $table;

    /**
     * @var array
     */
    protected array $describe;

    /**
     * @var DataGenerator
     */
    protected DataGenerator $dataGenerator;

    /**
     * @param string $table
     * @param array $describe
     */
    public function __construct(string $table, array $describe)
    {
        $this->table = $table;
        $this->describe = $describe;
        $this->dataGenerator = new DataGenerator();
    }

    /**
     * @return Generator
     */
    protected function interateTablesFields() : Generator
    {
        foreach ($this->describe as $column) {
            $column = new Column((array)$column);

            yield $column;
        }
    }

    /**
     * @return Generator
     */
    protected function interateTablesFieldsWhithoutPrimary() : Generator
    {
        foreach ($this->interateTablesFields() as $column) {
            if ($column->isPrimaryKey()) {
                continue;
            }

            yield $column;
        }
    }

    /**
     * @return string
     */
    abstract protected function template() : string;

    /**
     * @return string
     */
    abstract protected function format() : string;

    /**
     * @return string
     */
    public function build(): string
    {
        return $this->format();
    }
}