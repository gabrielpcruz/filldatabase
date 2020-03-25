<?php

require "../bootstrap.php";

use core\Controller;
use core\Method;
use core\Parameters;
use app\classes\FillError;

try {
    $controller = new Controller();
    $controller = $controller->load();

    $method = new Method();
    $method = $method->load($controller);

    $parameter = new Parameters();
    $parameter = $parameter->load();

    $controller->$method($parameter);
} catch (FillError $e) {
    dd($e);
}
