<?php

namespace app\classes;

use app\models\Connection;


class Consulta{

    public static function retorna_tabelas()
    {
        $conexao = Connection::connect();
        $resultado = $conexao->query("SHOW TABLES");

        while ($row = $resultado->fetch(\PDO::FETCH_NUM)) {
            $tables[] = $row[0];
        }

        $tabelas = array();

        foreach($tables as $key => $tabela){
            array_push($tabelas, $tabela);
        }

        return $tabelas;
    }

    public static function retorna_campos($tabela)
    {

        $conexao = Connection::connect();
        $resultado = $conexao->query("DESC $tabela");
        $i = 0;

        while ($row = $resultado->fetch(\PDO::FETCH_ASSOC)) {
            $fields[] = $row;
        }

        $campo_info = array();

        foreach($fields as $key => $campo){
            if($campo['Key'] != "PRI" || ($campo['Extra'] == '' && $campo['Key'] == "PRI")){
                $array = array();

                $array['campo'] = $campo['Field'];
                $array['tipo']  = $campo['Type'];

                array_push($campo_info, $array);
            }
        }

        return $campo_info;
    }

    public static function retorna_tabelas_info($tabelas)
    {
        $conexao = Connection::connect();

        $tabelas_info = array();

        foreach ($tabelas as $tabela) {
            $query = "desc $tabela";
            $results = $conexao->query($query);
            foreach ($results as $key => $campo) {
                if ($key == 'Type') {
                    $array = array();

                    $array["tabela"] = $tabela;
                    $array["tipo"]   = $campo['Type'];

                    array_push($tabelas_info, $array);
                }
            }
        }

        return $tabelas_info;
    }

}