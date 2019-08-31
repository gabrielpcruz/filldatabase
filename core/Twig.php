<?php

/* abcdefghijklmnopqrstuvx */
namespace core;

/**
 * Class Twig
 * @package core
 */
class Twig
{

    /**
     * @var
     */
    private $twig;

    /**
     * @return \Twig_Environment
     */
    public function loadTwig()
    {
        $this->twig = new \Twig_Environment($this->loadViews(), [
            'debug' => true,
            // 'cache' => ROOT . '/cache',
            'auto_reload' => true
        ]);

        return $this->twig;
    }

    /**
     * @return \Twig_Loader_Filesystem
     */
    private function loadViews()
    {
        return new \Twig_Loader_Filesystem('../app/views');
    }

    /**
     * @return mixed
     */
    public function loadExtensions()
    {
        return $this->twig->addExtension(new \Twig_Extensions_Extension_Text());
    }
}
