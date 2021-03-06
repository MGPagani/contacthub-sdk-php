<?php
namespace QueryBuilder\Tests\QueryBuilder\Condition;

use ContactHub\QueryBuilder\Condition\CompositeCondition;
use ContactHub\Tests\QueryBuilder\Condition\FakeCondition;

class CompositeConditionTest extends \PHPUnit_Framework_TestCase
{
    public function testWithOneCondition()
    {
        $condition = CompositeCondition::where(
            'OR',
            new FakeCondition()
        );

        $expected = [
            'type' => 'composite',
            'conjunction' => 'OR',
            'conditions' => [
                ['fake_condition']
            ]
        ];

        assertEquals($expected, $condition->build());
    }

    public function testWithMultipleCondition()
    {
        $condition = CompositeCondition::where(
            'INTERSECT',
            new FakeCondition(),
            new FakeCondition()
        );

        $expected = [
            'type' => 'composite',
            'conjunction' => 'INTERSECT',
            'conditions' => [
                ['fake_condition'],
                ['fake_condition']
            ]
        ];

        assertEquals($expected, $condition->build());

    }
}
