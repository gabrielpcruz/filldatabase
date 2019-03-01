<?php

namespace FillDataBase;

require '../autoload.php';

class Conexao{

    public static function pegarConexao(){
        try {

            return new \PDO("mysql:host=localhost;dbname=filldatabase", "root", "root");
        } catch (\Exception $e) {

           throw new \Exception($e);
        }
    }

    public static function insert($sql)
    {
        $con = Conexao::pegarConexao();
        $stmt = $con->prepare($sql);
        $stmt->execute();
    }

}