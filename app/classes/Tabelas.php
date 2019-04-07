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
class Tabelas
{

    /**
     * @throws \Exception
     */
    public function ajaxTabelas()
    {
        $tabelas = Consulta::retorna_tabelas();
        return json_encode($tabelas);
    }

    /**
     * @param $tabela
     * @return false|string
     * @throws \Exception
     */
    public function ajaxCampos($tabela)
    {
        $campos = Consulta::retorna_campos($tabela);
        return json_encode($campos);
    }
}
