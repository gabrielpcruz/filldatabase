<?php

use App\Business\Data\DataType;
use Codeception\Test\Unit;

class DataTypeTest extends Unit
{
    /**
     * @return void
     */
    public function testMustAssertInt()
    {
        $integer = [
            'Type' => 'int(11) unsigned',
        ];

        $type = DataType::getTypeBySimilarity($integer['Type']);

        $this->assertEquals(DataType::INT, $type);
    }

    /**
     * @return void
     */
    public function testMustAssertVarChar()
    {
        $integer = [
            'Type' => 'varchar(45)',
        ];

        $type = DataType::getTypeBySimilarity($integer['Type']);

        $this->assertEquals(DataType::VARCHAR, $type);
    }

    /**
     * @return void
     */
    public function testMustAssertDecimal()
    {
        $integer = [
            'Type' => 'DECIMAL(10, 2)',
        ];

        $type = DataType::getTypeBySimilarity($integer['Type']);

        $this->assertEquals(DataType::DECIMAL, $type);
    }

    /**
     * @return void
     */
    public function testMustAssertDateTime()
    {
        $integer = [
            'Type' => 'datetime',
        ];

        $type = DataType::getTypeBySimilarity($integer['Type']);

        $this->assertEquals(DataType::DATETIME, $type);
    }

    /**
     * @return void
     */
    public function testMustAssertBlob()
    {
        $integer = [
            'Type' => 'BLOB',
        ];

        $type = DataType::getTypeBySimilarity($integer['Type']);

        $this->assertEquals(DataType::BLOB, $type);
    }

    /**
     * @return void
     */
    public function testMustAssertBinary()
    {
        $integer = [
            'Type' => 'BINARY()',
        ];

        $type = DataType::getTypeBySimilarity($integer['Type']);

        $this->assertEquals(DataType::BINARY, $type);
    }

    /**
     * @return void
     */
    public function testMustAssertLongBlob()
    {
        $integer = [
            'Type' => 'LONGBLOB',
        ];

        $type = DataType::getTypeBySimilarity($integer['Type']);

        $this->assertEquals(DataType::LONGBLOB, $type);
    }

    /**
     * @return void
     */
    public function testMustAssertMediumBlob()
    {
        $integer = [
            'Type' => 'MEDIUMBLOB',
        ];

        $type = DataType::getTypeBySimilarity($integer['Type']);

        $this->assertEquals(DataType::MEDIUMBLOB, $type);
    }

    /**
     * @return void
     */
    public function testMustAssertTinyBlob()
    {
        $integer = [
            'Type' => 'TINYBLOB',
        ];

        $type = DataType::getTypeBySimilarity($integer['Type']);

        $this->assertEquals(DataType::TINYBLOB, $type);
    }

    /**
     * @return void
     */
    public function testMustAssertVarBinary()
    {
        $integer = [
            'Type' => 'VARBINARY()',
        ];

        $type = DataType::getTypeBySimilarity($integer['Type']);

        $this->assertEquals(DataType::VARBINARY, $type);
    }

    /**
     * @return void
     */
    public function testMustAssertDate()
    {
        $integer = [
            'Type' => 'DATE',
        ];

        $type = DataType::getTypeBySimilarity($integer['Type']);

        $this->assertEquals(DataType::DATE, $type);
    }

    /**
     * @return void
     */
    public function testMustAssertLongText()
    {
        $integer = [
            'Type' => 'LONGTEXT',
        ];

        $type = DataType::getTypeBySimilarity($integer['Type']);

        $this->assertEquals(DataType::LONGTEXT, $type);
    }

    /**
     * @return void
     */
    public function testMustAssertTinyInt()
    {
        $integer = [
            'Type' => 'tinyint(1) unsigned',
        ];

        $type = DataType::getTypeBySimilarity($integer['Type']);

        $this->assertEquals(DataType::TINYINT, $type);
    }

    /**
     * @return void
     */
    public function testMustAssertText()
    {
        $integer = [
            'Type' => 'TEXT()',
        ];

        $type = DataType::getTypeBySimilarity($integer['Type']);

        $this->assertEquals(DataType::TEXT, $type);
    }
}