<?php

namespace app\controllers\home;

use app\controllers\ContainerController;

use app\classes\Config;
use app\classes\Tabelas;
use app\classes\SortData;
use app\classes\FillView;
use app\models\Connection;

/**
 * Class HomeController
 * @package app\controllers\home
 */
class HomeController extends ContainerController
{

    /**
     * Carrega a tela inicial
     */
    public function index()
    {
        $this->view([
            'title' => "Home | {$this->title}",
            'session' => (object) $_SESSION,
            'version' => FillView::$VERSION
        ], "home.index");
    }

    /**
     *
     */
    public function prepararConexao()
    {
        $config_ajax = new Config();
        echo $config_ajax->prepararConexao();
    }

    /**
     * Conecta no banco de dados informado
     * @throws \Exception
     */
    public function conectar()
    {
        $config_ajax = new Config();
        echo $config_ajax->init();
    }

    /**
     * Desconecta no banco de dados informado
     */
    public function desconectar()
    {
        $_SESSION['host']     = null;
        $_SESSION['usuario']  = null;
        $_SESSION['senha']    = null;
        $_SESSION['banco']    = null;
        $_SESSION['sucesso']  = null;
        $_SESSION['banco']    = null;
        Config::destroyConnection();
    }

    /**
     * Carrega na tela, as tabelas do banco disponíveis
     * @throws \Exception
     */
    public function carregarTabelas()
    {
        $tabelas_ajax = new Tabelas();
        echo $tabelas_ajax->ajaxTabelas();
    }

    /**
     * Carrega na tela, os campos da tabela no banco
     * @throws \Exception
     */
    public function carregarCampos()
    {
        $tabelas_ajax = new Tabelas();
        echo $tabelas_ajax->ajaxCampos($_POST['tabela']);
    }

    /**
     * Preenche a tabela com dados fake
     * @throws \Exception
     */
    public function filldatabase()
    {
        $sorte_data_ajax = new SortData();
        echo $sorte_data_ajax->fillDataBase($_POST['campos'], $_POST['tabela']);
    }
}
