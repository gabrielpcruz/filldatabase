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
        $tabelas = Consulta::retornaTabelas();
        return json_encode($tabelas);
    }

    /**
     * @param $tabela
     * @return false|string
     * @throws \Exception
     */
    public function ajaxCampos($tabela)
    {
        $campos = Consulta::retornaCampos($tabela);
        return json_encode($campos);
    }
}
