<?php

namespace App\Http\Filldatabase;

use Generator;

class QueryCreator
{
    /**
     * @var string
     */
    private const INSERT_TEMPLATE = " INSERT INTO TABLE_NAME (FIELDS_NAME) VALUES VALUES_INSIDE ";

    /**
     * @var string
     */
    private string $temporaryQuery = "";

    /**
     * @var array
     */
    private array $tableDescribe = [];

    /**
     * @var string
     */
    private string $tableName;

    /**
     * @var DataGenerator
     */
    private DataGenerator $dataGenerator;

    /**
     * @param string $tableName
     */
    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
        $this->dataGenerator = new DataGenerator();
    }

    /**
     * @param array $tableDescribe
     * @return $this
     */
    public function addTableDescribe(array $tableDescribe): QueryCreator
    {
        $this->tableDescribe = $tableDescribe;

        return $this;
    }

    /**
     * @return QueryCreator
     */
    public function insert(): QueryCreator
    {
        $this->temporaryQuery = str_replace(
            "TABLE_NAME",
            $this->tableName,
            QueryCreator::INSERT_TEMPLATE
        );

        $this->temporaryQuery = str_replace(
            "FIELDS_NAME",
            $this->formatFields(),
            $this->temporaryQuery
        );

        $this->temporaryQuery = str_replace(
            "VALUES_INSIDE",
            $this->formatValues(),
            $this->temporaryQuery
        );

        return $this;
    }

    /**
     * @return Generator
     */
    private function interateTablesFields() : Generator
    {
        foreach ($this->tableDescribe as $column) {
            $column = new Column((array)$column);

            if ($column->isPrimaryKey()) {
                continue;
            }

            yield $column;
        }
    }

    /**
     * @return string
     */
    private function formatValues(): string
    {
        $values = [];

        $quantidade = 1;

        for ($i = 1; $i <= $quantidade; $i++) {
            $valuesPart = [];

            foreach ($this->interateTablesFields() as $column) {
                $value = $this->dataGenerator->fromType($column->type(), $column->length());
                $valuesPart[] = "'{$value}'";
            }

            $values[] = " ( " . implode(", ", $valuesPart) . " ) ";
        }

        return implode(", ", $values);
    }

    /**
     * @return string
     */
    private function formatFields(): string
    {
        $fields = [];

        foreach ($this->interateTablesFields() as $column) {
            $fields[] = $column->name();
        }

        return implode(", ", $fields);
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