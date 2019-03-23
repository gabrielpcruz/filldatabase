<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 31/05/18
 * Time: 19:51
 */

namespace app\classes;

use Faker\Factory;
use app\models\Connection;
use app\classes\ParserDado;


class SortDataAjax
{

    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * @var array
     */
    private $types;

    /**
     * @var string
     */
    private $tabela;

    /**
     * Prepara as coisas antes de executar tudo
     *
     * SortDataAjax constructor.
     */
    public function __construct(){

        $this->faker = Factory::create();
    }

    /**
     *
     * @param $colunas
     * @param $tabela
     * @return false|string
     * @throws \Exception
     */
    public function fillDataBase($colunas, $tabela)
    {
        //Trasnforma o Json em array
        $colunasArray = json_decode($colunas);
        $this->tabela = $tabela;

        //Prepara o insert
        return $this->insertPrepare($colunasArray);

    }

    /**
     * Prepara o insert
     * @param $dados
     * @return false|string
     * @throws \Exception
     */
    private function insertPrepare($dados)
    {
        //Trata os dados para um array
        $this->dataTrate($dados);

        //INSERT INTO $tabela ($campo1, ... ) VALUES ($item1, ...)
        $insert = "INSERT INTO {$this->tabela} (";

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

                $dado = $this->gerarDado($coluna['tipo'], $coluna['tamanho']);

                if (is_null($dado)) {
                    $vals .= " NULL, ";
                } else {
                    $vals .= " '" . $dado . "',";
                }
            }
        }

        //Remove a última vírgula dos valores
        $insert .= $this->trataVirgula($vals);

        $insert .= " )";

        $stmt = Connection::insert($insert);

        if ($stmt->errorCode() == "00000") {
            return json_encode(['msg' => FillMessage::MG0003, "status" => "success"]);
        } else {
            return json_encode(['msg' => FillMessage::MG0004 . $stmt->errorInfo()[2], 'status' => "error"]);
        }
    }

    /**
     * Deixa o array mais organizado com map
     * @param $data
     */
    private function dataTrate(&$data)
    {
        //Inicializa os arrays de colunas e valores
        $colunas = [];
        foreach ($data as $column) {
            $coluna = [
                'nome' => $column->nomeColuna,
                'tipo' => $column->tipoColuna,
                'tamanho' => $column->tamanhoColuna,
            ];

            array_push($colunas, $coluna);
        }

        $data = [];
        array_push($data, $colunas);
    }

    /**
     * TODO: Criar mecanismo para gerar um dado, usando o faker, de acordo com o tipo e o tamaho, uma opção é usar o FillEnum para isso
     *
     * tudo pra minúsculo e depois chama outra função
     * @param $tipoDado
     * @return mixed
     */
    private function gerarDado($tipoDado, $tamanhoDado)
    {
        $tipo = strtoupper($tipoDado);

        ParserDado::setFaker($this->faker);

        return ParserDado::getDado($tipo, $tamanhoDado);
    }

    /**
     * Gera um dado de acordo com o tipo passado
     * @param $tipo
     * @return mixed
     */
    private function getDado($tipo)
    {
      return $this->types[$tipo];
    }

    /**
     * @param $string
     * @return bool|string
     */
    public function trataVirgula($string)
    {
        //Procura a posição da última ocorrência da vírgula
        $last = strripos($string, ",");
        //Onde ficarão os parâmetros
        $params = "";
        //Verifica se a última posição é de fato uma vírgula. Se sim, põe a string sem a vírgula em $params
        if ($string[$last] === ',') {
            $params = substr($string, 0, $last);
        }
        return $params;
    }
}