<?php

use App\Http\Filldatabase\QueryCreator;
use Codeception\Test\Unit;

class QueryCreatorTest extends Unit
{
    /**
     * @dataProvider tableProvider
     * @param $describe
     * @return void
     */
    public function testDataSetFromFileMustAssertContainsString($describe)
    {
        $keys = array_keys($describe);
        $table = reset($keys);

        $fields = implode(', ', array_keys($describe[$table]));

        $contains = " INSERT INTO {$table} ({$fields}) VALUES ";

        $queryCreator = new QueryCreator($table, $describe[$table]);

        $this->assertStringContainsStringIgnoringCase($contains, $queryCreator->insert()->build());
    }

    /**
     * @return string[]
     */
    public function tableProvider(): array
    {
        return [
            [
                require_once("tests/_data/query/example_1.php"),
            ],
            [
                require_once("tests/_data/query/example_2.php"),
            ]
        ];
    }
}