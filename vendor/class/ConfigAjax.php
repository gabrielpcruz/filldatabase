<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 06/06/18
 * Time: 20:28
 */

namespace FillDataBase;

require_once '../autoload.php';

class ConfigAjax extends Ajax
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $db_name;

    /**
     * @return string
     */
    private function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getDbName()
    {
        return $this->db_name;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $password;

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->sessionControl();

        if($this->ParamsVerify()) {
            $this->setConfig();
        } else {
            $this->setSuccess(false);
        }
    }

    public function sessionControl()
    {
        /**
         * O if abaixo serve para controlar a sessão
         *
         * Se a sessão estiver ativa e esta sessão conter uma variável chamada sucesso
         * quer dizer que esse arquivo já foi aberto antes e consegui abrir uma conexão
         * com o banco de dados.
         *
         * Neste caso a sessão deve ser destruída porque a página foi redirecionada da index.php
         * pelo botão 'logout'.
         *
         * No entanto, se se o 	'if' resultar em falso, quer dizer que ainda não foi feita uma
         * conexão com o banco, logo não há porque destruir a sessão que não foi criada
         *
         * Este trecho de código foi extraído da página da documentação oficial do PHP
         *
         * link("http://php.net/manual/pt_BR/function.session-destroy.php");
         *
         */

        if(isset($_SESSION['sucesso']) && isset($_SESSION)){
            // Apaga todas as variáveis da sessão
            $_SESSION = array();

            // Se é preciso matar a sessão, então os cookies de sessão também devem ser apagados.
            // Nota: Isto destruirá a sessão, e não apenas os dados!
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }

            // Por último, destrói a sessão
            session_destroy();
        }
    }

    public function ParamsVerify()
    {
        if (
            (isset($_POST['host'])       && $_POST['host']       != "") &&
            (isset($_POST['banco'])      && $_POST['banco'] 	 != "") &&
            (isset($_POST['usuario'])    && $_POST['usuario']    != "") &&
            (isset($_POST['senha'])      && $_POST['senha']      != "")
        )
        {
            //Setando variáveis
            $this->host     = $_POST['host'];
            $this->db_name  = $_POST['banco'];
            $this->user     = $_POST['usuario'];
            $this->password = $_POST['senha'];

            return true;
        }

        return false;

    }

    private function setSuccess($status = true)
    {
        if($status) {
            unset($_SESSION['preenchimento']);
        } else {
            $_SESSION['preenchimento'] = "falha";
        }
    }

    public function setConfig()
    {
        $this->setSuccess();

        //Configuração do config.php
        $file = fopen("../config.php", "w");

        //Seta a string com as configurações
        $string = $this->getStgringConfig();


        fwrite($file, $string);

        //Conexão
        try{
            $conexao = Conexao::pegarConexao();
        } catch( Exception $e){
            throw new Exception( $e);
            $_SESSION['erro-conexao'] = "erro-conexao";
        }


        if($conexao){
            $_SESSION['sucesso'] = "sucesso";
            $_COOKIE['sucesso'] = "sucesso";

            $_SESSION['host']    = $this->getHost();
            $_SESSION['banco']   = $this->getDbName();
            $_SESSION['usuario'] = $this->getUser();
            $_SESSION['senha']   = $this->getPassword();

            //Remove a variável que mostrava erro de conexão
            unset($_SESSION['erro-conexao']);
        }
    }

    public function getStgringConfig()
    {
        return
            '<?php 

            define("DB_DRIVE", "mysql"); 
            define("DB_HOSTNAME", "'. $this->getHost()     .'");
            define("DB_DATABASE", "'. $this->getDbName()   .'");
            define("DB_USER",     "'. $this->getUser()     .'");
            define("DB_PASSWORD", "'. $this->getPassword() .'");
            ';
    }
}