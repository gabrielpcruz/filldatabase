<?php

namespace App\Http\Filldatabase;

class QueryCreator
{
    /**
     * @var array
     */
    private array $tableDescribe = [];

    /**
     * @var string
     */
    private string $tableName;

    /**
     * @param string $tableName
     */
    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
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
     * @return array|string|string[]
     */
    public function insert() : string
    {
        $query = " INSERT INTO TABLE_NAME (FIELDS_NAME) VALUES VALUES_INSIDE ";

        $query = str_replace("TABLE_NAME", $this->tableName, $query);

        $dateGenerator = new DataGenerator();
        $fields = [];

        foreach ($this->tableDescribe as $column) {
            $column = new Column((array) $column);

            if ($column->isPrimaryKey()) {
                continue;
            }

            $fields[] = $column->name();
        }

        $valuesPart = [];
        $values = [];

        $quantidade = 1;
        for ($i = 1; $i <= $quantidade; $i++) {
            foreach ($this->tableDescribe as $column) {
                $column = new Column((array) $column);

                if ($column->isPrimaryKey()) {
                    continue;
                }

                $value = $dateGenerator->fromType($column->type(), $column->length());
                $valuesPart[] = "'{$value}'";
            }

            $values[] = " ( " . implode(", ", $valuesPart) . " ) ";
            $valuesPart = [];
        }

        $query = str_replace("FIELDS_NAME", implode(", ", $fields), $query);

        return str_replace("VALUES_INSIDE", implode(", ", $values), $query);
    }
}