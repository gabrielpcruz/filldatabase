<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 07/05/18
 * Time: 00:16
 */

namespace app\classes;

/**
 * Class TabelasAjax
 */
class TabelasAjax extends Ajax
{

    public function ajaxTabelas()
    {
        $tabelas = Consulta::retorna_tabelas();

        echo json_encode($tabelas);
    }

    /**
     * @param $tabela
     */
    public function ajaxCampos($tabela)
    {
        $campos = Consulta::retorna_campos($tabela);

        echo json_encode($campos);
    }
}

$ajax = new TabelasAjax();