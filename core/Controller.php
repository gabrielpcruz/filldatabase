<?php

/* namespace sd*/
namespace core;

use app\classes\FillCode;
use app\classes\FillMessage;
use app\classes\Uri;
use app\exceptions\ControllerNotExistsException;

class Controller
{

    /**
     * Contém a URI que foi solicitada na requisição
     *
     * @var mixed
     */
    private $uri;

    /**
     * Contém as pastas de controller setadas automaticamente
     *
     * @var array
     */
    private $folders = [];

    /**
     * @var string
     */
    private $controller;

    /**
     * @var string
     */
    private $namespace;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->uri = Uri::uri();
    }

    /**
     * @return mixed
     * @throws ControllerNotExistsException
     */
    public function load()
    {
        if ($this->isHome()) {
            return $this->controllerHome();
        }

        return $this->controllerNotHome();
    }

    /**
     * @return mixed
     * @throws ControllerNotExistsException
     */
    private function controllerHome()
    {
        if (!$this->controllerExists('HomeController')) {
            throw new ControllerNotExistsException(FillMessage::MG0005, FillCode::CG0005);
        }

        return $this->instatiateController();
    }

    /**
     * @return mixed
     * @throws ControllerNotExistsException
     */
    private function controllerNotHome()
    {
        $controller = $this->getControllerNotHome();

        if (!$this->controllerExists($controller)) {
            throw new ControllerNotExistsException(FillMessage::MG0005($controller), FillCode::CG0005);
        }

        return $this->instatiateController($controller);
    }

    /**
     * @return string
     */
    private function getControllerNotHome()
    {
        if (substr_count($this->uri, "/") > 1) {
            list($controller) = array_values(array_filter(explode("/", $this->uri)));
            return ucfirst($controller) . "Controller";
        }

        return ucfirst(ltrim($this->uri, "/")) . "Controller";
    }

    /**
     * @return bool
     */
    private function isHome()
    {
        return ($this->uri == "/");
    }

    /**
     * @param $controller
     * @return bool
     */
    private function controllerExists($controller)
    {
        $controllerExists = false;

        $this->setFolders();

        foreach ($this->folders as $folder) {
            if (class_exists($folder . "\\" . $controller)) {
                $controllerExists = true;
                $this->namespace = $folder;
                $this->controller = $controller;
            }
        }

        return $controllerExists;
    }

    /**
     * @return mixed
     */
    private function instatiateController()
    {
        $controller = $this->namespace . "\\" . $this->controller;

        return new $controller();
    }

    /**
     * Seta os paths presentes na pasta controllers
     */
    private function setFolders()
    {
        # Faz um scan das pastas disponíveis
        $folders = scandir("../app/controllers");

        # Itera sobre o array setando os controllers existentes
        foreach ($folders as $folder) {
            if (!in_array($folder, [".", "..", "ContainerController.php"])) {
                $this->folders[] = "app\\controllers\\" . $folder;
            }
        }
    }
}
