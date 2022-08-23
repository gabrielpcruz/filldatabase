<?php

namespace App\Http\Filldatabase;

use DateTime;

class DataGenerator
{
    /**
     * @param string $type
     * @return int|string
     */
    public function fromType(string $type)
    {
        switch ($type) {
            case DataType::INT:
                return $this->int();
                break;
            case DataType::DATE:
                return $this->date();
                break;
            case DataType::VARCHAR:
                return $this->varchar();
                break;
            case DataType::DATETIME:
                return $this->datetime();
                break;
            default:
                return "";
        }
    }

    /**
     * @return int
     */
    private function int() : int
    {
        return 1;
    }

    /**
     * @return string
     */
    private function date(): string
    {
        return (new DateTime())->format('d/m/Y');
    }

    /**
     * @return string
     */
    private function varchar() : string
    {
        return "sdasd";
    }

    /**
     * @return string
     */
    private function datetime(): string
    {
        return (new DateTime())->format('Y/m/d H:i:s');
    }
}