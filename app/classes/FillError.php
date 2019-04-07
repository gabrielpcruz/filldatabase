<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 06/05/18
 * Time: 23:07
 */

namespace app\classes;

class FillError extends \Exception
{

    /**
     * Error constructor.
     * @param $mensagem
     * @param $codigo
     */
    public function __construct($mensagem, $codigo)
    {
        $this->setMessage($mensagem);
        $this->setCode($codigo);

        return FillError::init();
    }

    /**
     *
     */
    public function init()
    {
        return json_encode(array(
            "code"    => $this->getCode(),
            "message" => $this->getMessage(),
            "file"    => $this->getFile(),
            "line"    => $this->getLine()
        ));
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @param mixed $line
     */
    public function setLine($line)
    {
        $this->line = $line;
    }
}