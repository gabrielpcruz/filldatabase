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
        return QueryTemplate::update();
    }

    /**
     * @return string
     */
    public function format(): string
    {
        $update = str_replace(
            "TABLE_NAME",
            $this->table->getName(),
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

        foreach ($this->table->interateFieldsWhithoutPrimary() as $key => $column) {
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

        foreach ($this->table->interateFields() as $column) {
            if ($column->isPrimaryKey()) {
                $tableId = $column->name();
                break;
            }
        }

        return " {$this->table->getName()}.{$tableId} = {$this->id} ";
    }
}