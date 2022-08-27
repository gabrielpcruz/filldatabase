<?php

namespace App\Http\Filldatabase;

class DataType
{
    public const INT = 'INT';
    public const VARCHAR = 'VARCHAR';
    public const DECIMAL = 'DECIMAL';
    public const DATETIME = 'DATETIME';
    public const BLOB = 'BLOB';
    public const BINARY = 'BINARY';
    public const LONGBLOB = 'LONGBLOB';
    public const MEDIUMBLOB = 'MEDIUMBLOB';
    public const TINYBLOB = 'TINYBLOB';
    public const VARBINARY = 'VARBINARY';
    public const DATE = 'DATE';
    public const LONGTEXT = 'LONGTEXT';
    public const TINYINT = 'TINYINT';

    private static array $types = [
      self::INT,
      self::VARCHAR,
      self::DECIMAL,
      self::DATETIME,
      self::BLOB,
      self::BINARY,
      self::LONGBLOB,
      self::MEDIUMBLOB,
      self::TINYBLOB,
      self::VARBINARY,
      self::DATE,
      self::LONGTEXT,
      self::TINYINT,
    ];

    /**
     * @param string $string
     * @return string
     */
    public static function getTypeBySimilarity(string $string) : string
    {




        list($percentage, $typeChoose) = self::getPercentage($string);

        $second = substr($string, 0, 7);

        list($secondPercent, $secondChoose) = self::getPercentage($second);

        if ($secondPercent > $percentage) {
            $percentage = $secondPercent;
            $typeChoose = $secondChoose;
        }

        $third = substr($string, strlen($string) - 7, strlen($string));
        list($thirdPercent, $thirdChoose) = self::getPercentage($third);

        if ($thirdPercent > $percentage) {
            $typeChoose = $thirdChoose;
        }

        return $typeChoose;
    }

    /**
     * @param $string
     * @return array
     */
    private static function getPercentage($string): array
    {
        $similatiry = 0;
        $choose = "";

        foreach (self::$types as $type) {
            $percentage = string_similarity($string, $type);
            if ($percentage > $similatiry) {
                $similatiry = $percentage;
                $choose = $type;
            }
        }

        return array($similatiry, $choose);
    }
}