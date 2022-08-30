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
    private array $columns = [];

    /**
     * @var ForeignKey[]
     */
    private array $foreigns = [];

    /**
     * @var string
     */
    private string $name;

    /**
     * @param string $name
     * @param array $describe
     */
    public function __construct(string $name, array $describe)
    {
        $this->describe = $describe;
        $this->fillColumns();
        $this->fillForeing();
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
     * @return void
     */
    private function fillForeing()
    {
        if (array_key_exists('foreign', $this->describe)) {
            foreach ($this->interateForeings() as $foreign) {
                $this->foreigns[] = $foreign;
            }
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
     * @return ForeignKey[]
     */
    public function foreigns(): array
    {
        return $this->foreigns;
    }

    /**
     * @return Generator
     */
    public function interateFields() : Generator
    {
        foreach ($this->describe['table'] as $column) {
            $column = new Column((array) $column);

            yield $column;
        }
    }

    /**
     * @return Generator
     */
    public function interateForeings() : Generator
    {
        foreach ($this->describe['foreign'] as $field) {
            $field = new ForeignKey((array) $field);

            yield $field;
        }
    }

    /**
     * @return bool
     */
    public function hasForeignKey(): bool
    {
        return count($this->foreigns);
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