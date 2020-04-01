<?php
/**
 * Esta classe é responsável por retornar dados referentes ao conteúdo das tabelas
 *
 * PHP version 7
 *
 * @package    App
 * @subpackage Classes
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2020 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license    http://opensource.org/licenses/gpl-license.php MIT
 * @link       https://github.com/gabrielpcruz/filldatabase
 */

namespace app\classes;

use Exception;

/**
 * Esta classe é responsável por retornar dados referentes ao conteúdo das tabelas
 *
 * Class TabelasAjax
 */
class Tabelas
{


    /**
     * Este método retorna as tabelas do banco especificado
     * @return string
     * @throws Exception Lança uma excecao do banco especificado.
     */
    public function ajaxTabelas()
    {
        $tabelas = Consulta::retornaTabelas();
        return json_encode($tabelas);

    }//end ajaxTabelas()


    /**
     * Este método retorna os campos da tabela passada por parâmetro
     *
     * @param string $tabela Esta variável contém o nome da tabela que
     * queremos recuperar os campos.
     *
     * @return string
     * @throws Exception Lança uma excecao do banco especificado.
     */
    public function ajaxCampos($tabela)
    {
        $campos = Consulta::retornaCampos($tabela);
        return json_encode($campos);

    }//end ajaxCampos()


}//end class
