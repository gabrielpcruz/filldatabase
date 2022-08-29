<?php

namespace App\Business\Query;

class QueryTemplate
{
    /**
     * @return string
     */
    public static function insert(): string
    {
        return " INSERT INTO TABLE_NAME (FIELDS_NAME) VALUES VALUES_INSIDE ";
    }

    /**
     * @return string
     */
    public static function update(): string
    {
        return " UPDATE TABLE_NAME SET_FIELDS_NAME_VALUES WHERE QUERIES_CONDITIONS ";
    }

    /**
     * @param $table
     * @return string
     */
    public static function describe($table): string
    {
        return sprintf("DESCRIBE %s ", $table);
    }

    /**
     * @param $database
     * @param $table
     * @return string
     */
    public static function foreingKey($database, $table): string
    {
        $query = <<<TEMPLATE
            SELECT
                TABLE_NAME,
                COLUMN_NAME,
                CONSTRAINT_NAME,
                REFERENCED_TABLE_NAME,
                REFERENCED_COLUMN_NAME
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE 
                REFERENCED_TABLE_SCHEMA = '%s'
                AND TABLE_NAME = '%s' 
TEMPLATE;

        return sprintf($query, $database, $table);
    }
}