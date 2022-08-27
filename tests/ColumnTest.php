<?php

use App\Business\Data\DataType;
use App\Business\Table\Column;
use Codeception\Test\Unit;

class ColumnTest extends Unit
{
    /**
     * @dataProvider tableProvider
     * @return void
     */
    public function testColumnsTablesMustMacthWithArrayDataSet(array $table)
    {
        foreach ($table as $key => $tableColumn) {
            $column = new Column($tableColumn);

            if ($key === 'sulphur') {
                $this->assertEquals('sulphur', $column->name());
                $this->assertEquals('NO', $column->null());
                $this->assertEquals(DataType::INT, strtoupper($column->type()));
                $this->assertEquals('PRI', $column->key());
                $this->assertEquals('11', $column->length());
            }

            if ($key === 'chocolate') {
                $this->assertEquals('chocolate', $column->name());
                $this->assertEquals('YES', $column->null());
                $this->assertEquals(DataType::TEXT, strtoupper($column->type()));
                $this->assertEquals('', $column->key());
            }

            if ($key === 'proposal') {
                $this->assertEquals('proposal', $column->name());
                $this->assertEquals('YES', $column->null());
                $this->assertEquals(DataType::TINYINT, strtoupper($column->type()));
                $this->assertEquals('MUL', $column->key());
                $this->assertEquals('1', $column->length());
            }
        }
    }

    /**
     * @return string[]
     */
    public function tableProvider(): array
    {
        return [
            [
                require_once("tests/_data/column/example_1.php")
            ]
        ];
    }
}