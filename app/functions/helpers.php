<?php


function dd($dump)
{
    var_dump($dump);
    die();
}

/**
 * TODO: Mudar essa função para uma classe mais coerente, não deve ficar na classe de consulta
 * @param $tipo
 * @return mixed
 */
function tratarTamanho($tipo)
{
    $tamanho = strpos($tipo, "(");
    return str_replace(["(", ")"], "", substr($tipo, $tamanho, strlen($tipo)));
}

/**
 * TODO: Mudar essa função para uma classe mais coerente, não deve ficar na classe de consulta
 * @param $tipo
 * @return string
 */
function tratarTipo($tipo)
{
    $tamanho = strpos($tipo, "(");
    return strtoupper(substr($tipo, 0, $tamanho));
}
