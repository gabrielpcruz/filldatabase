<?php

namespace app\controllers\portal;

use app\controllers\ContainerController;
use app\models\portal\Contratado;
use app\models\portal\Area;

class HomeController extends ContainerController{

	public function index()
	{

		$contratado = new Contratado();
		$contratados = $contratado->all();

		$categorias = new Area();

		$this->view([
      'title' => "You Service",
      'categorias' => $categorias->all()->sortBy("descricao"),
      'profissionais' => ['Profissional 1', "Profissional 2", "Profissional 3", "Profissional 4", "Profissional 5", "Profissional 6", "Profissional 7", "Profissional 8", "Profissional 9", "Profissional 10"],
      'perfis' => $contratados
    ], "portal.index");
	}

}
