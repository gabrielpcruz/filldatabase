<?php

namespace App\Business\Table;

class ForeignKey extends Field
{
    /**
     * @return string
     */
    public function constraintName(): string
    {
        return $this->describe['CONSTRAINT_NAME'] ?? '';
    }

    /**
     * @return string
     */
    public function tableOrigin(): string
    {
        return $this->describe['TABLE_NAME'] ?? '';
    }

    /**
     * @return string
     */
    public function columnOrigin(): string
    {
        return $this->describe['COLUMN_NAME'] ?? '';

    }

    /**
     * @return string
     */
    public function columnForeing(): string
    {
        return $this->describe['REFERENCED_COLUMN_NAME'] ?? '';

    }

    /**
     * @return string
     */
    public function tableForeing(): string
    {
        return $this->describe['REFERENCED_TABLE_NAME'] ?? '';
    }
}