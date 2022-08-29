<?php

namespace App\Business\Table;

use Generator;

class Table
{
    /**
     * @var array
     */
    private array $describe;

    /**
     * @var Column[]
     */
    private array $columns;
    private string $name;

    /**
     * @param string $name
     * @param array $describe
     */
    public function __construct(string $name, array $describe)
    {
        $this->describe = $describe;
        $this->fillColumns();
        $this->name = $name;
    }

    /**
     * @return void
     */
    private function fillColumns()
    {
        foreach ($this->interateFields() as $column) {
            $this->columns[] = $column;
        }
    }

    /**
     * @return Column[]
     */
    public function columns(): array
    {
        return $this->columns;
    }

    /**
     * @return Generator
     */
    public function interateFields() : Generator
    {
        foreach ($this->describe['table'] as $column) {
            $column = new Column((array)$column);

            yield $column;
        }
    }

    /**
     * @return Generator
     */
    public function interateFieldsWhithoutPrimary() : Generator
    {
        foreach ($this->interateFields() as $column) {
            if ($column->isPrimaryKey()) {
                continue;
            }

            yield $column;
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}