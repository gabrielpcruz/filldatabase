<?php

namespace app\classes;

use app\models\Connection;
use Exception;
use Illuminate\Database\Capsule\Manager as DB;

class Consulta
{

    public static $connection;

    /**
     * @return array
     * @throws Exception
     */
    public static function retornaTabelas()
    {
        Consulta::$connection = Connection::getConnection();
        $result = DB::select("SHOW TABLES");

        $tables = array();

        foreach ($result as $tabela) {
            $array = get_object_vars($tabela);
            $firstElement = reset(array_values($array));
            array_push($tables, $firstElement);
        }

        return $tables;
    }

    /**
     * @param $tabela
     * @return array
     * @throws Exception/
     */
    public static function retornaCampos($tabela)
    {

        Consulta::$connection = Connection::getConnection();
        $result = DB::select("DESC $tabela");

        $campo_info = array();

        foreach ($result as $key => $campo) {
            if ($campo->Key != "PRI" || ($campo->Extra == '' && $campo->Key == "PRI")) {
                $array = array();

                $array['campo'] = $campo->Field;
                $array['tipo']  = Consulta::tratarTipo($campo->Type);
                $array['tamanho']  = Consulta::tratarTamanho($campo->Type);

                array_push($campo_info, $array);
            }
        }

        return $campo_info;
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
