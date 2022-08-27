<?php

namespace App\Http\Filldatabase;

use DateTime;
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
                break;
            case DataType::DATE:
                return $this->date($length);
                break;
            case DataType::VARCHAR:
                return $this->varchar($length);
                break;
            case DataType::DATETIME:
                return $this->datetime($length);
                break;
            case DataType::LONGTEXT:
                return $this->longtext($length);
                break;
            case DataType::TINYINT:
                return $this->tinyint($length);
                break;
            default:
                return "";
        }
    }

    /**
     * @param $length
     * @return int
     */
    private function int($length) : int
    {
        $times = $length > 3 ? $length - 2 : $length;
        $length = intval(str_repeat('9', $times));

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
        $times = $length > 3 ? $length - 2 : $length;
        $length = intval(str_repeat('9', $times));

        return $this->facker->numberBetween(1, $length);
    }
}