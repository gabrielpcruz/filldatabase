<?php

namespace app\controllers\home;

use app\controllers\ContainerController;

use app\classes\ConfigAjax;
use app\classes\TabelasAjax;
use app\classes\SortDataAjax;
use app\models\Connection;

class HomeController extends ContainerController{

    /**
     * Carrega a tela inicial
     */
	public function index()
	{
        $this->view([
            'title' => "Home | {$this->title}",
            'session' => (object) $_SESSION
        ], "home.index");
	}

    /**
     *
     */
	public function prepararConexao()
    {
        $config_ajax = new ConfigAjax();
        echo $config_ajax->prepararConexao();
    }

    /**
     * Conecta no banco de dados informado
     */
	public function conectar()
    {
        $config_ajax = new ConfigAjax();
        echo $config_ajax->init();
    }

    /**
     * Desconecta no banco de dados informado
     */
    public function desconectar()
    {
        $_SESSION['host']     = NULL;
        $_SESSION['usuario']  = NULL;
        $_SESSION['senha']    = NULL;
        $_SESSION['banco']    = NULL;
        $_SESSION['sucesso']  = NULL;
        $_SESSION['banco']    = NULL;
        Connection::desconectar();
        $config = new ConfigAjax();
        $config->destroyConnection();
    }

    /**
     * Carrega na tela, as tabelas do banco disponíveis
     */
    public function carregarTabelas()
    {
        $tabelas_ajax = new TabelasAjax();
        echo $tabelas_ajax->ajaxTabelas();
    }

    /**
     * Carrega na tela, os campos da tabela no banco
     */
    public function carregarCampos()
    {
        $tabelas_ajax = new TabelasAjax();
        echo $tabelas_ajax->ajaxCampos($_POST['tabela']);
    }

    /**
     * Preenche a tabela com dados fake
     */
    public function filldatabase()
    {
        $sorte_data_ajax = new SortDataAjax();
        echo $sorte_data_ajax->fillDataBase($_POST['campos'], $_POST['tabela']);
    }
}
