<?php

namespace app\models;

abstract class Model {

  protected $connection;

  public function __construct()
  {
    $this->connection = Connection::connect();
  }

  public function all()
  {
    $sql = "SELECT * FROM {$this->table}";
    $list = $this->connection->query($sql);
    $list->execute();

    return $list->fetchAll();
  }
}



 ?>
