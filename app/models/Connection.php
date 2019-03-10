<?php

namespace app\models;
use \PDO;
use app\classes\Bind;

class Connection {

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
    $config = (object) Bind::get('config')->database;
    $pdo = new PDO("mysql:host=$config->host;dbname=$config->dbname;charset=$config->charset", $config->username, $config->password, $config->options);

    return $pdo;
  }

  /**
   * @return PDO
   * @throws \Exception
   */
  public static function getConn()
  {
    if (!Connection::$connection) {
      Connection::$connection = Connection::connect();
    }

    return Connection::$connection;
  }

  /**
   * @return bool
   */
  public function isConnected()
  {
    return isset(Connection::$connection);
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
