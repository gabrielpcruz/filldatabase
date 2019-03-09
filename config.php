<?php

return [
  'database' => [
    'host' => 'localhost',
    'dbname' => 'youservice',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
    'options' => [
      "PDO::ATTR_ERRMOD" => "PDO::ERRMOD_EXCEPTION",
      "PDO::ATTR_DEFAULT_FETCH_MODE" => "PDO::FETCH_OBJ"
    ]
  ]
]



 ?>
