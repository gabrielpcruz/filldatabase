<?php

namespace app\models;

use \PDO;
use app\classes\Bind;

class Connection
{

    /**
     * @var PDO
     */
    private static $connection;

    /**
     * @return PDO
     * @throws \Exception
     */
    private static function connect()
    {
        try {

            $config = (object)Bind::get('config')->database;
            $pdo = new \PDO("mysql:host=$config->host;dbname=$config->dbname;charset=$config->charset", $config->username, $config->password, $config->options);

            return $pdo;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @return PDO
     * @throws \Exception
     */
    public static function getConn()
    {
        try {

            if (!Connection::$connection) {
                Connection::$connection = Connection::connect();
            }

            return Connection::$connection;

        } catch (\Exception $e) {

            throw new \Exception($e->getMessage(), $e->getCode());

        }
    }

    /**
     * @return bool
     */
    public static function isConnected()
    {
        return isset(Connection::$connection);
    }

    public static function desconectar()
    {
        self::$connection = NULL;
    }

    /**
     * @param $sql
     * @return bool|\PDOStatement
     * @throws \Exception
     */
    public static function insert($sql)
    {
        $con = Connection::getConn();
        $stmt = $con->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
}

?>
