<?php

namespace App\Business\Query;

use App\Business\Table\Table;

class Update extends Query
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @param Table $table
     * @param int $id
     */
    public function __construct(Table $table, int $id)
    {
        parent::__construct($table);
        $this->id = $id;
    }

    /**
     * @return string
     */
    protected function template(): string
    {
        return " UPDATE TABLE_NAME SET_FIELDS_NAME_VALUES WHERE QUERIES_CONDITIONS ";
    }

    /**
     * @return string
     */
    public function format(): string
    {
        $update = str_replace(
            "TABLE_NAME",
            $this->table,
            $this->template()
        );

        $update = str_replace(
            "SET_FIELDS_NAME_VALUES",
            $this->formatFields(),
            $update
        );

        return str_replace(
            "QUERIES_CONDITIONS",
            $this->formatWheres(),
            $update
        );
    }

    /**
     * @return string
     */
    protected function formatFields(): string
    {
        $fields = [];

        foreach ($this->interateTablesFieldsWhithoutPrimary() as $key => $column) {
            $value = $this->dataGenerator->fromType($column->type(), $column->length());

            $set = ($key === 0) ? "SET" : "";

            $fields[] = " {$set} {$column->name()} = '{$value}' ";
        }

        return implode(", ", $fields);
    }

    /**
     * @return string
     */
    protected function formatWheres(): string
    {
        $tableId = "";

        foreach ($this->interateTablesFields() as $column) {
            if ($column->isPrimaryKey()) {
                $tableId = $column->name();
                break;
            }
        }

        return " {$this->table}.{$tableId} = '{$this->id}' ";
    }
}