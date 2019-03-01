<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 31/05/18
 * Time: 19:51
 */

namespace FillDataBase;

use Faker\Factory;

require_once '../autoload.php';

class SortDataAjax extends Ajax
{

    private $faker;

    private $types;

    //Prepara as coisas antes de executar tudo
    public function __construct(){

        $this->faker = Factory::create();

        $this->types = [
            "varchar(255)" => $this->faker->name(),
            "int(2)" => $this->faker->numberBetween(0,80)
        ];

        parent::__construct();
    }

    //Método genérico
    public function fillDataBase($colunas)
    {
        //Trasnforma o Json em array
        $colunasArray = json_decode($colunas);

        //Prepara o insert
        $insert = $this->insertPrepare($colunasArray);

    }

    //Prepara o insert
    private function insertPrepare($dados)
    {
        //Trata os dados para um array
        $this->dataTrate($dados);

        //INSERT INTO $tabela ($campo1, ... ) VALUES ($item1, ...)
        $insert = "INSERT INTO pessoa (";

        //Gera a primeira parte do INSERT
        $cols = "";
        foreach ($dados as $key => $colunas) {
            foreach ($colunas as $coluna) {
                $cols .= " " . $coluna['nome'] . ",";
            }
        }

        //Remove a última vírgula das colunas
        $insert .= $this->trataVirgula($cols);

        $insert .= " ) VALUES ( ";

        //Gera os dados de fato usando o \Faker
        $vals = "";
        foreach ($dados as $key => $colunas) {
            foreach ($colunas as $coluna) {

                $dado = $this->gerarDado($coluna['valor']);

                $vals .= " '" . $dado . "',";
            }
        }

        //Remove a última vírgula dos valores
        $insert .= $this->trataVirgula($vals);

        $insert .= " )";


        Conexao::insert($insert);
    }

    //Deixa o array mais organizado com map
    private function dataTrate(&$data)
    {
        //Inicializa os arrays de colunas e valores
        $colunas = [];

        foreach ($data as $columns) {
            foreach ($columns as $column) {

                $coluna = [
                    'nome' => $column->nomeColuna,
                    'valor' => $column->tipoColuna
                ];

                array_push($colunas, $coluna);
            }
        }

        $data = [];
        array_push($data, $colunas);
    }

    //tudo pra minúsculo e depois chama outra função
    private function gerarDado($tipoDado)
    {
        $tipo = strtolower($tipoDado);
        return $this->getDado($tipo);
    }

    //Gera um dado de acordo com o tipo passado
    private function getDado($tipo)
    {
      return $this->types[$tipo];
    }


}

$ajax = new SortDataAjax();