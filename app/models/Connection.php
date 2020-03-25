<?php

namespace app\models;

use app\classes\Bind;
use Exception;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

/**
 * Class Connection
 * @package app\models
 */
class Connection
{

    /**
     * @var Connection
     */
    private static $connection;

    /**
     * Connection constructor.
     * @param $configurations
     */
    public function __construct(array $configurations)
    {
        $capsule = new Manager();
        $capsule->addConnection($configurations);
        $capsule->setEventDispatcher(new Dispatcher(new Container()));
        $capsule->setAsGlobal();
    }

    /**
     * @return Connection
     * @throws Exception
     */
    public static function getConnection()
    {
        if (!self::$connection) {
            self::$connection = new self(Bind::get('config'));
        }

        return self::$connection;
    }
}
