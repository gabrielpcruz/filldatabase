<?php

namespace core;

class Twig {

  private $twig;

  private $functions = [];

  public function loadTwig()
  {
    $this->twig = new \Twig_Environment($this->loadViews(), [
      'debug' => true,
      // 'cache' => ROOT . '/cache',
      'auto_reload' => true
    ]);

    return $this->twig;
  }

  private function loadViews()
  {
    return new \Twig_Loader_Filesystem('../app/views');
  }

  public function loadExtensions()
  {
    return $this->twig->addExtension(new \Twig_Extensions_Extension_Text());
  }
}
