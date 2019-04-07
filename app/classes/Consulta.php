<?php

namespace app\classes;

use app\models\Connection;


class Consulta{

    /**
     * @return array
     * @throws \Exception
     */
    public static function retorna_tabelas()
    {
        $conexao = Connection::getConn();
        $resultado = $conexao->query("SHOW TABLES");

        $tables = [];

        while ($row = $resultado->fetch(\PDO::FETCH_NUM)) {
            $tables[] = $row[0];
        }

        $tabelas = array();

        foreach($tables as $key => $tabela){
            array_push($tabelas, $tabela);
        }

        return $tabelas;
    }

    /**
     * @param $tabela
     * @return array
     * @throws \Exception/
     */
    public static function retorna_campos($tabela)
    {

        $conexao = Connection::getConn();
        $resultado = $conexao->query("DESC $tabela");
        $fields = [];


        while ($row = $resultado->fetch(\PDO::FETCH_ASSOC)) {
            $fields[] = $row;
        }

        $campo_info = array();

        foreach($fields as $key => $campo){
            if($campo['Key'] != "PRI" || ($campo['Extra'] == '' && $campo['Key'] == "PRI")){

                $array = array();

                $array['campo'] = $campo['Field'];
                $array['tipo']  = Consulta::tratarTipo($campo['Type']);
                $array['tamanho']  = Consulta::tratarTamanho($campo['Type']);

                array_push($campo_info, $array);
            }
        }

        return $campo_info;
    }

    /**
     * @deprecated
     * @param $tabelas
     * @return array
     * @throws \Exception
     */
    public static function retorna_tabelas_info($tabelas)
    {
        $conexao = Connection::getConn();

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

    /**
     * TODO: Mudar essa função para uma classe mais coerente, não deve ficar na classe de consulta
     * @param $tipo
     * @return mixed
     */
    private static function tratarTamanho($tipo)
    {
        $tamanho = strpos($tipo, "(");
        return str_replace(["(", ")"], "", substr($tipo, $tamanho, strlen($tipo)));
    }

    /**
     * TODO: Mudar essa função para uma classe mais coerente, não deve ficar na classe de consulta
     * @param $tipo
     * @return string
     */
    private static function tratarTipo($tipo)
    {
        $tamanho = strpos($tipo, "(");
        return strtoupper(substr($tipo, 0, $tamanho));
    }
}