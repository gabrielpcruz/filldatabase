<?php

use App\Http\Filldatabase\DataType;
use Codeception\Test\Unit;

class DataTypeTest extends Unit
{

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testMustAssertInt()
    {
        $integer = [
            'Type' => 'int(11) unsigned',
        ];

        $type = DataType::getTypeBySimilarity($integer['Type']);

        $this->assertEquals(DataType::INT, $type);
    }
}