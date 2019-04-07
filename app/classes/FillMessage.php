<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 22/03/19
 * Time: 22:20
 */

namespace app\classes;


class FillMessage
{
    const MG0001 = "Conectado com sucesso.";
    const MG0002 = "Falha na conexão.";
    const MG0003 = "Registro inserido com sucesso!";
    const MG0004 = "Falha ao inserir registro: ";
    const MG0005 = "Esse controller não existe: %s %s %s";


    public static function __callStatic($name, $argumentos)
    {
        $mensagem = "";

        if (count($argumentos)) {
            eval("\$mensagem = sprintf(self::$name, ". explode(",", $argumentos) ." );");
        }

        var_dump($mensagem);exit;
    }

}