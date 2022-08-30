<?php

namespace App\Business\Table;

abstract class Field
{
    /**
     * @var array
     */
    protected array $describe;

    /**
     * @param array|null $describe
     */
    public function __construct(array $describe = null)
    {
        $this->describe = $describe;
    }
}