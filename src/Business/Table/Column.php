<?php

namespace App\Business\Table;

use App\Business\Data\DataType;

class Column
{
    /**
     * @var array
     */
    private array $column;

    /**
     * @param array $column
     */
    public function __construct(array $column)
    {
        $this->column = $column;
    }

    /**
     * @return string
     */
    public function type() : string
    {
        return DataType::getTypeBySimilarity($this->column['Type']);
    }

    /**
     * @return bool
     */
    public function isEnum() : bool
    {
        return $this->type() === DataType::ENUM;
    }

    /**
     * @return string
     */
    public function enumValue() : string
    {
        preg_match_all('/\"[A-zÀ-ú]+\"|\'[A-zÀ-ú]+\'/', $this->column['Type'], $options);

        $options = reset($options);

        shuffle($options);

        return str_replace("'", '', reset($options));
    }

    /**
     * @return string
     */
    public function length() : string
    {
        preg_match('/\d+/', $this->column['Type'], $lenght);

        return $lenght ? reset($lenght) : 0;
    }

    /**
     * @return string
     */
    public function key() : string
    {
        return $this->column['Key'];
    }

    /**
     * @return string
     */
    public function null() : string
    {
        return $this->column['Null'];
    }

    /**
     * @return string
     */
    public function name() : string
    {
        return $this->column['Field'];
    }

    /**
     * @return bool
     */
    public function isPrimaryKey() : bool
    {
        return $this->column['Key'] === 'PRI';
    }
}