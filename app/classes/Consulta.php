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
            $arrayValues = array_values($array);
            $firstElement = reset($arrayValues);
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
                $array['tipo']  = tratarTipo($campo->Type);
                $array['tamanho'] = tratarTamanho($campo->Type);

                array_push($campo_info, $array);
            }
        }

        return $campo_info;
    }
}
