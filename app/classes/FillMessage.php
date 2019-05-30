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


//    public static function __callStatic($name, $argumentos)
//    {
//        $classe = get_called_class();
//        $mensagem = "FillMessage::$name";
//
//        if (count($argumentos) > 1) {
//            eval("\$mensagem = sprintf($mensagem, ". explode(",", $argumentos) ." );");
//        } else {
//            eval("\$mensagem = sprintf($mensagem, ".  $argumentos[0] . ");");
//        }
//
//        var_dump($mensagem);exit;
//
//    }
}
