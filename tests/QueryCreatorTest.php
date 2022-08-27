<?php

use App\Http\Filldatabase\QueryCreator;
use Codeception\Test\Unit;

class QueryCreatorTest extends Unit
{
    /**
     * @var QueryCreator
     */
    private QueryCreator $queryCreator;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->queryCreator = new QueryCreator('test');
        $this->queryCreator->addTableDescribe(
            [

            ]
        );
    }

    protected function _after()
    {
    }

    /**
     * @dataProvider tableProvider
     * @param $table
     * @return void
     */
    public function testDataSetFromFileMustAssertContainsString($table)
    {
        $keys = array_keys($table);
        $tableName = reset($keys);

        $fields = implode(', ', array_keys($table[$tableName]));

        $contains = " INSERT INTO {$tableName} ({$fields}) VALUES ";

        $queryCreator = new QueryCreator($tableName);
        $queryCreator->addTableDescribe($table[$tableName]);

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