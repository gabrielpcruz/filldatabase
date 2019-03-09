<?php

namespace app\controllers\home;

use app\controllers\ContainerController;

class HomeController extends ContainerController{

	public function index()
	{
        $this->view([
            'title' => "Home | {$this->title}"
        ], "home.index");
	}

}
