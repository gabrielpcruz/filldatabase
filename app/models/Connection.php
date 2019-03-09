<?php

namespace app\models;
use \PDO;
use app\classes\Bind;

class Connection {

  public static function connect()
  {
    $config = (object) Bind::get('config')->database;

    // $pdo = new PDO("mysql:localhost;dbname:youservice;", "root", "root");
    $pdo = new PDO("mysql:host=$config->host;dbname=$config->dbname;charset=$config->charset", $config->username, $config->password, $config->options);

    return $pdo;
  }

  public static function insert($sql)
  {
    $con = Connection::connect();
    $stmt = $con->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

}

 ?>
