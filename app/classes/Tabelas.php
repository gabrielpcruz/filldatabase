<?php
/**
 * Esta classe é responsável por retornar dados referentes ao conteúdo das tabelas
 *
 * PHP version 7
 *
 * @category Classes
 * @package  App
 * @author   Gabriel Cruz <gabriel.cruz116@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php MIT
 * @link     https://github.com/gabrielpcruz/filldatabase
 */

namespace app\classes;

use Exception;

/**
 * Esta classe é responsável por retornar dados referentes ao conteúdo das tabelas
 *
 * @category Classes
 * @package  App
 * @author   Gabriel Cruz <gabriel.cruz116@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php MIT
 * @link     https://github.com/gabrielpcruz/filldatabase
 * Class TabelasAjax
 */
class Tabelas
{

    /**
     * Este método retorna as tabelas do banco especificado
     * @return string
     * @throws Exception
     */
    public function ajaxTabelas()
    {
        $tabelas = Consulta::retornaTabelas();
        return json_encode($tabelas);
    }

    /**
     * Este método retorna os campos da tabela passada por parâmetro
     *
     * @param string $tabela esta variável contém o nome da tabela que
     * queremos recuperar os campos
     *
     * @return string
     * @throws Exception
     */
    public function ajaxCampos($tabela)
    {
        $campos = Consulta::retornaCampos($tabela);
        return json_encode($campos);
    }
}
