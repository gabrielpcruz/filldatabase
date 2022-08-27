<?php

use App\Http\Filldatabase\Column;
use App\Http\Filldatabase\DataType;
use Codeception\Test\Unit;

class ColumnTest extends Unit
{

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * @dataProvider arrayValidProvider
     * @return void
     */
    public function testSomeFeature(array $table)
    {
        foreach ($table as $key => $tableColumn) {
            $column = new Column($tableColumn);

            if ($key == 0) {
                $this->assertEquals('id_logtransmissaoarquivo', $column->name());
                $this->assertEquals('NO', $column->null());
                $this->assertEquals(DataType::INT, strtoupper($column->type()));
                $this->assertEquals('PRI', $column->key());
            }
        }
    }

    /**
     * @return string[]
     */
    public function arrayValidProvider(): array
    {
        return [
            [
                require_once ("tests/_data/table/example_1.php")
            ]
        ];
    }
}