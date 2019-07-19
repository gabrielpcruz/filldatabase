<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 31/05/18
 * Time: 19:51
 */

namespace app\classes;

use app\models\Connection;
use Faker\Factory;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class SortData
 * @package app\classes
 */
class SortData
{

    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * @var string
     */
    private $tabela;

    /**
     * @var array
     */
    private $inserts = [];

    /**
     * @var Connection
     */
    private $connection;

    /**
     * Prepara as coisas antes de executar tudo
     *
     * SortDataAjax constructor.
     */
    public function __construct()
    {
        $this->connection = Connection::getConnection();
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
        $this->insertPrepare($colunasArray);

        return $this->insert();
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

        $dadosInsert = [];

        //Gera os dados de fato usando o \Faker
        foreach ($dados as $key => $colunas) {
            foreach ($colunas as $coluna) {
                $dado = $this->makeData($coluna['tipo'], $coluna['tamanho']);

                $dadosInsert[$coluna['nome']] = $dado;
            }
        }

        $this->inserts[] = $dadosInsert;
    }

    /**
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
     *
     * @param $tipoDado
     * @return mixed
     */
    private function makeData($tipoDado, $tamanhoDado)
    {
        $tipo = strtoupper($tipoDado);

        ParserDado::setFaker($this->faker);

        return ParserDado::getDado($tipo, $tamanhoDado);
    }

    /**
     * @return false|string
     */
    private function insert()
    {

        foreach ($this->inserts as $insert) {
            try {
                $stmt = DB::table($this->tabela)->insert($insert);

                if ($stmt) {
                    return json_encode(['msg' => FillMessage::MG0003, "status" => "success"]);
                } else {
                    return json_encode(['msg' => FillMessage::MG0004 . $stmt->errorInfo()[2], 'status' => "error"]);
                }
            } catch (\Exception $e) {
                return json_encode(['msg' => $e->getMessage(), 'status' => "error"]);
            }
        }
    }
}
