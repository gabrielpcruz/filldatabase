<?php


/**
 * @param $dump
 */
function dd($dump)
{
    var_dump($dump);
    die();
}

/**
 *
 * @param $tipo
 * @return mixed
 */
function tratarTamanho($tipo)
{
    $tamanho = strpos($tipo, "(");
    return str_replace(["(", ")"], "", substr($tipo, $tamanho, strlen($tipo)));
}

/**
 *
 * @param $tipo
 * @return string
 */
function tratarTipo($tipo)
{
    $tamanho = strpos($tipo, "(");
    return strtoupper(substr($tipo, 0, $tamanho));
}
