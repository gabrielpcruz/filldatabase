<?php

namespace App\Business\Query;

class Insert extends Query
{
    /**
     * @return string
     */
    protected function template(): string
    {
        return QueryTemplate::insert();
    }

    /**
     * @return string
     */
    public function format(): string
    {
        $insert = str_replace(
            "TABLE_NAME",
            $this->table->getName(),
            $this->template()
        );

        $insert = str_replace(
            "FIELDS_NAME",
            $this->formatFields(),
            $insert
        );

        return str_replace(
            "VALUES_INSIDE",
            $this->formatValues(),
            $insert
        );
    }

    /**
     * @return string
     */
    protected function formatFields(): string
    {
        $fields = [];

        foreach ($this->table->interateFieldsWhithoutPrimary() as $column) {
            $fields[] = $column->name();
        }

        return implode(", ", $fields);
    }

    /**
     * @return string
     */
    protected function formatValues(): string
    {
        $values = [];

        $quantidade = 1;

        for ($i = 1; $i <= $quantidade; $i++) {
            $value = $this->formatValue();

            $values[] = " ({$value}) ";
        }

        return implode(", ", $values);
    }

    /**
     * @return string
     */
    private function formatValue(): string
    {
        $valuesPart = [];

        foreach ($this->table->interateFieldsWhithoutPrimary() as $column) {
            $value = $this->dataGenerator->fromType($column->type(), $column->length());
            $valuesPart[] = "'{$value}'";
        }

        return implode(", ", $valuesPart);
    }
}