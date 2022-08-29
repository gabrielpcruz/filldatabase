<?php

use App\Business\Query\QueryCreator;
use App\Business\Table\Table;
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
        $tableName = reset($keys);
        $describeTable = $describe[$tableName];

        $configs['table'] =  $describeTable;

        $fields = implode(', ', array_keys($describeTable));

        $contains = " INSERT INTO {$tableName} ({$fields}) VALUES ";

        $table = new Table($tableName, $configs);

        $queryCreator = new QueryCreator($table);

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