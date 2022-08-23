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
    ];

    /**
     * @param string $string
     * @return string
     */
    public static function getTypeBySimilarity(string $string) : string
    {
        $similatiry = 0;
        $typeChoose = "";

        foreach (self::$types as $type) {
            $percentage = string_similarity($string, $type);

            if ($percentage > $similatiry) {
                $similatiry = $percentage;
                $typeChoose = $type;
            }
        }

        return $typeChoose;
    }
}