<?php

namespace app\controllers;

use app\traits\View;

abstract class ContainerController {
    protected $title = "home";
    use View;
}
