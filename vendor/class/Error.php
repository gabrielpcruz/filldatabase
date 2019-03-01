<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 06/05/18
 * Time: 23:07
 */

namespace FillDataBase;

class Error extends Exception
{
    /**
     * @var
     */
    public static $code;

    /**
     * @var
     */
    public static $message;
    /**
     * @var
     */
    public static $file;
    /**
     * @var
     */
    public static $line;


    /**
     * Error constructor.
     * @param Exception $error
     */
    public function __construct(Exception $error)
    {
        Error::setCode($error->getCode());
        Error::setMessage($error->getMessage());
        Error::setFile($error->getFile());
        Error::setLine($error->getLine());

        Error::init();
    }

    /**
     *
     */
    public static function init()
    {
        set_error_handler("error_handler");

        function error_handler()
        {
            echo json_encode(array(
                "code"    => Error::getCode(),
                "message" => Error::getMessage(),
                "file"    => Error::getFile(),
                "line"    => Error::getLine()
            ));
        }
    }

    /**
     * @return mixed
     */
    public static function getCode()
    {
        return self::$code;
    }

    /**
     * @param mixed $code
     */
    public static function setCode($code)
    {
        self::$code = $code;
    }

    /**
     * @return mixed
     */
    public static function getMessage()
    {
        return self::$message;
    }

    /**
     * @param mixed $message
     */
    public static function setMessage($message)
    {
        self::$message = $message;
    }

    /**
     * @return mixed
     */
    public static function getFile()
    {
        return self::$file;
    }

    /**
     * @param mixed $file
     */
    public static function setFile($file)
    {
        self::$file = $file;
    }

    /**
     * @return mixed
     */
    public static function getLine()
    {
        return self::$line;
    }

    /**
     * @param mixed $line
     */
    public static function setLine($line)
    {
        self::$line = $line;
    }
}