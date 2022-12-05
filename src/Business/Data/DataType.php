<?php

namespace App\Business\Data;

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
    public const TEXT = 'TEXT';
    public const CHAR = 'CHAR';
    public const ENUM = 'ENUM';

    /**
     * @var array|string[]
     */
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
      self::TEXT,
      self::CHAR,
      self::ENUM,
    ];

    /**
     * @param string $string
     * @return string
     */
    public static function getTypeBySimilarity(string $string) : string
    {
        $possibilities = [
            $string,
            substr($string, 0, 7),
            substr($string, strlen($string) - 7, strlen($string)),
            substr($string, strlen($string) - 5, strlen($string))
        ];

        $oldPercent = 0;
        $oldType = "";

        foreach ($possibilities as $possibility) {
            list($percentage, $typeChoose) = self::getPercentage($possibility);

            if ($percentage > $oldPercent) {
                $oldPercent = $percentage;
                $oldType = $typeChoose;
            }
        }

        return $oldType;
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

            if ($similatiry > 0 && $percentage > $similatiry) {
                $similatiry = $percentage;
                $choose = $type;
            }
        }

        return [$similatiry, $choose];
    }
}