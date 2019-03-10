<?php

namespace app\controllers\home;

use app\controllers\ContainerController;

use app\classes\ConfigAjax;
use app\classes\TabelasAjax;
use app\classes\SortDataAjax;

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
     * Conecta no banco de dados informado
     */
	public function conectar()
    {
        $config_ajax = new ConfigAjax();
        echo $config_ajax->init();
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
