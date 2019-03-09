<?php

namespace app\controllers\home;

use app\controllers\ContainerController;

use app\classes\Ajax;
use app\classes\ConfigAjax;
use app\classes\TabelasAjax;
use app\classes\SortDataAjax;

class HomeController extends ContainerController{

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
	public function conectar()
    {
        $config_ajax = new ConfigAjax();
        echo $config_ajax->init();
    }

    /**
     *
     */
    public function carregarTabelas()
    {
        $tabelas_ajax = new TabelasAjax();
        echo $tabelas_ajax->ajaxTabelas();
    }

    /**
     *
     */
    public function carregarCampos()
    {
        $tabelas_ajax = new TabelasAjax();
        echo $tabelas_ajax->ajaxCampos($_POST['tabela']);
    }

    /**
     *
     */
    public function filldatabase()
    {
        $sorte_data_ajax = new SortDataAjax();
        echo $sorte_data_ajax->fillDataBase($_POST['campos'], $_POST['tabela']);
    }

}
