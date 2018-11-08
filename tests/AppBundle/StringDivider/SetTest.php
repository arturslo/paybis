<?php

namespace AppBundle\StringDivider;

use PHPUnit\Framework\TestCase;

class SetTest extends TestCase
{
    public function test_next()
    {
        $set = new Set([1, 2, 3]);

        $this->assertEquals(1, $set->getValue());
        $set->next();
        $this->assertEquals(2, $set->getValue());
        $set->next();
        $this->assertEquals(3, $set->getValue());
    }

    public function test_throws_exception_when_cannot_call_next()
    {
        $this->expectException(\LogicException::class);
        $set = new Set([1]);
        $set->next();
    }

    public function test_has_next_return_false_when_on_last_index()
    {
        $set = new Set([1]);
        $this->assertEquals(false, $set->hasNext());
    }

    public function test_has_next_return_true_when__not_on_last_index()
    {
        $set = new Set([1, 2]);
        $this->assertEquals(true, $set->hasNext());
    }
}