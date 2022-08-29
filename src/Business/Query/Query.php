<?php

namespace App\Business\Query;

use App\Business\Data\DataGenerator;
use App\Business\Table\Column;
use App\Business\Table\Table;
use Generator;

abstract class Query
{
    /**
     * @var Table
     */
    protected Table $table;

    /**
     * @var DataGenerator
     */
    protected DataGenerator $dataGenerator;

    /**
     * @param Table $table
     */
    public function __construct(Table $table)
    {
        $this->table = $table;
        $this->dataGenerator = new DataGenerator();
    }

    /**
     * @return string
     */
    abstract protected function template() : string;

    /**
     * @return string
     */
    abstract protected function format() : string;

    /**
     * @return string
     */
    public function build(): string
    {
        return $this->format();
    }
}