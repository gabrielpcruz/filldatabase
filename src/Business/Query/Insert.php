<?php

namespace App\Business\Query;

class Insert extends Query
{
    /**
     * @var string
     */
    protected string $insert;

    /**
     * @return void
     */
    public function doInsert(): void
    {
        $this->insert = str_replace(
            "TABLE_NAME",
            $this->table->getName(),
            $this->template()
        );

        $this->insert = str_replace(
            "FIELDS_NAME",
            $this->formatFields(),
            $this->insert
        );

        $this->insert = str_replace(
            "VALUES_INSIDE",
            $this->formatValues(),
            $this->insert
        );
    }

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
    protected function format(): string
    {
        $this->doInsert();

        return $this->insert;
    }

    /**
     * @return string
     */
    private function formatFields(): string
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
    private function formatValues(): string
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

            if ($column->isEnum()) {
                $value = $column->enumValue();
            } else {
                $value = $this->dataGenerator->fromType($column->type(), $column->length());
            }

            if (
                $this->table->hasForeignKey()
            ) {
                $lastInsert = "";
                $isForeingColumn = false;

                foreach ($this->table->foreigns() as $foreign) {
                    if ($column->name() === $foreign->columnOrigin()) {
                        $lastInsert = QueryTemplate::lastIdFromTable(
                            $foreign->columnForeing(),
                            $foreign->tableForeing()
                        );

                        $isForeingColumn = true;
                    }
                }

                $valuesPart[] = $isForeingColumn ? " ({$lastInsert}) " : "'{$value}'";
            } else {
                $valuesPart[] = "'{$value}'";
            }
        }

        return implode(", ", $valuesPart);
    }
}