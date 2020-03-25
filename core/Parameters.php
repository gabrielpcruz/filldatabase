<?php

namespace core;

use app\classes\Uri;

/**
 * Class Parameters
 * @package core
 */
class Parameters
{

    /**
     * @var mixed
     */
    private $uri;

    /**
     * Parameters constructor.
     */
    public function __construct()
    {
        $this->uri = Uri::uri();
    }

    /**
     * @return object
     */
    public function load()
    {
        return $this->getParameter();
    }

    /**
     * @return object
     */
    public function getParameter()
    {
        if (substr_count($this->uri, "/") > 2) {
            $parameter = array_values(array_filter(explode("/", $this->uri)));
            return (object)[
                'parameter' => filter_var($parameter[2], FILTER_SANITIZE_STRING),
                'next' => filter_var($this->getNextParameter(2), FILTER_SANITIZE_STRING)
            ];
        }
    }

    /**
     * @param $actual
     * @return mixed
     */
    public function getNextParameter($actual)
    {
        $parameter = array_values(array_filter(explode("/", $this->uri)));

        return $parameter[$actual + 1] ?? $parameter[$actual];
    }
}
