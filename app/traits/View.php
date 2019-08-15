<?php

namespace app\traits;

use core\Twig;

/**
 * Trait View
 * @package app\traits
 */
trait View
{
    /**
     * @return \Twig_Environment
     */
    private function twig()
    {
        $twig = new Twig();
        $loadTwig = $twig->loadTwig();

        $twig->loadExtensions();

        return $loadTwig;
    }

    /**
     * @param $data
     * @param $view
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function view($data, $view)
    {
        $template = $this->twig()->load(str_replace(".", "/", $view) . ".html");

        return $template->display($data);
    }
}
