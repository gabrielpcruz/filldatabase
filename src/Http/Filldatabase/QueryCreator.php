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
    public function query()
    {
        $query = " INSERT INTO TABLE_NAME VALUES ( VALUES_INSIDE ) ";

        $query = str_replace("TABLE_NAME", $this->tableName, $query);

        $dateGenerator = new DataGenerator();
        $values = [];
        foreach ($this->tableDescribe as $column) {
            $column = new Column((array) $column);

            $value = $dateGenerator->fromType($column->type());
            $values[] = "'{$value}'";
        }

        return str_replace("VALUES_INSIDE", implode(", ", $values), $query);
    }
}