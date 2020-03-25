<?php

namespace core;

use app\classes\Uri;
use app\exceptions\MethodNotExistsException;

/**
 * Class Method
 * @package core
 */
class Method
{

    /**
     * @var mixed
     */
    private $uri;

    /**
     * Method constructor.
     */
    public function __construct()
    {
        $this->uri = Uri::uri();
    }

    /**
     * @param $controller
     * @return string
     * @throws MethodNotExistsException
     */
    public function load($controller)
    {
        $method = $this->getMethod();

        if (!method_exists($controller, $method)) {
            throw new MethodNotExistsException("Esse método não existe: {$method}.");
        }

        return $method;
    }

    /**
     * @return string
     */
    private function getMethod()
    {
        if (substr_count($this->uri, "/") > 1) {
            list($controller, $method) = array_values(array_filter(explode("/", $this->uri)));
            return $method;
        }

        return "index";
    }
}
