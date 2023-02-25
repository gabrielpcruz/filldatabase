<?php

namespace App\Business\Data;

use Faker\Factory;
use Faker\Generator;

class DataGenerator
{
    /**
     * @var Generator
     */
    private Generator $facker;

    public function __construct()
    {
        $this->facker = Factory::create();
    }

    /**
     * @param string $type
     * @param int $length
     * @return int|string
     */
    public function fromType(string $type, int $length = 0)
    {
        switch ($type) {
            case DataType::INT:
                return $this->int($length);
            case DataType::DATE:
                return $this->date($length);
            case DataType::VARCHAR:
                return $this->varchar($length);
            case DataType::DATETIME:
                return $this->datetime($length);
            case DataType::LONGTEXT:
                return $this->longtext($length);
            case DataType::TINYINT:
                return $this->tinyint($length);
            case DataType::TEXT:
                return $this->text($length);
            case DataType::CHAR:
                return $this->char($length);
            case DataType::TIMESTAMP:
                return $this->timestamp($length);
            case DataType::BIGINT:
                return $this->bigint($length);
            default:
                return "";
        }
    }

    /**
     * @param $length
     * @return int
     */
    private function getCaracteresLength($length): int
    {
        $times = $length;

        if ($length > 3) {
            $times = $length - 3;
        }

        if ($length > 10) {
            $times = $length - 5;
        }

        if ($length > 13) {
            $times = $length - 6;
        }

        return intval(str_repeat('9', $times));
    }

    /**
     * @param $length
     * @return int
     */
    private function int($length) : int
    {
        $length = $this->getCaracteresLength($length);

        return $this->facker->numberBetween(1, $length);
    }

    /**
     * @param $length
     * @return string
     */
    private function date($length): string
    {
        return $this->facker->date();
    }

    /**
     * @param $length
     * @return string
     */
    private function varchar($length) : string
    {
        return $this->facker->text($length);
    }

    /**
     * @param $length
     * @return string
     */
    private function datetime($length): string
    {
        return $this->facker->dateTime()->format('Y-m-d H:i:s');
    }

    /**
     * @param int $length
     * @return string
     */
    private function longtext(int $length): string
    {
        return $this->facker->text(1000);
    }

    /**
     * @param int $length
     * @return string
     */
    private function tinyint(int $length): string
    {
        $length = $this->getCaracteresLength($length);

        return $this->facker->numberBetween(1, $length);
    }

    /**
     * @param int $length
     * @return string
     */
    private function text(int $length): string
    {
        return $this->facker->text(1000);
    }

    /**
     * @param int $length
     * @return string
     */
    private function char(int $length): string
    {
        $text = $this->facker->text(1000);

        return substr($text, 0, $length);
    }

    /**
     * @param int $length
     * @return string
     */
    private function enum(int $length): string
    {
        $text = $this->facker->text(1000);

        return substr($text, 0, $length);
    }

    /**
     * @param int $length
     * @return int
     */
    private function timestamp(int $length): int
    {
        return $this->facker->dateTime()->getTimestamp();
    }

    /**
     * @param int $length
     * @return int
     */
    private function bigint(int $length): int
    {
        return $this->int($length);
    }
}