<?php

namespace app\controllers;

use app\traits\View;

/**
 * Class ContainerController
 * @package app\controllers
 */
abstract class ContainerController
{
    use View;

    protected $title = "home";
}
