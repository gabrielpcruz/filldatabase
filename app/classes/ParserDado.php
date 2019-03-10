<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 10/03/19
 * Time: 14:06
 */

namespace app\classes;


class ParserDado
{

    private static $faker;

    private const INT = "INT";
    private const VARCHAR = "VARCHAR";
    private const DECIMAL = "DECIMAL";

    private static $tiposDados = [
        'INT' => ['numberBetween'],
        'VARCHAR' => ['name', 'firstName', 'userName', 'address'],
        'DECIMAL' => ['randomFloat']
    ];

    /**
     * @param $facker
     */
    public static function setFaker($facker)
    {
        ParserDado::$faker = $facker;
    }

    /**
     * @param $tipo
     * @param $tamanho
     * @return mixed
     */
    public  static function getDado($tipo, $tamanho)
    {
        if ($tipo == self::INT || $tipo == self::DECIMAL) {
            return ParserDado::$faker->{self::$tiposDados[$tipo][0]}(1, $tamanho);
        }

        if ($tipo == self::VARCHAR) {
            return substr(ParserDado::$faker->{self::$tiposDados[$tipo][rand(0, count(self::$tiposDados[$tipo]) - 1)]}, 0, $tamanho);
        }
    }
}