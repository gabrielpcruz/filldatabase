<?php

namespace FillDataBase;

require_once '../autoload.php';

class Consulta{

    public static function retorna_tabelas()
    {

        $query = "show tables";
        $conexao = Conexao::pegarConexao();

        $resultado = $conexao->query($query);
        
        $tabelas = array();

        foreach($resultado as $key => $tabela){
            array_push($tabelas, $tabela['Tables_in_filldatabase']);
        }

        return $tabelas;
    }

    public static function retorna_campos($tabela)
    {

        $conexao = Conexao::pegarConexao();
        $query = "desc $tabela";
        $results = $conexao->query($query);
        
        $campo_info = array();

        foreach($results as $key => $campo){
            if(!$campo['Key'] == "PRI"){
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
        $conexao = Conexao::pegarConexao();

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