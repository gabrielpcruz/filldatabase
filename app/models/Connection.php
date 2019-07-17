<?php

namespace app\models;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Connection
{
    public function __construct($configurations)
    {
        $capsule = new Manager;
        $capsule->addConnection($configurations);
        $capsule->setEventDispatcher(new Dispatcher(new Container));
        $capsule->setAsGlobal();
    }
}
