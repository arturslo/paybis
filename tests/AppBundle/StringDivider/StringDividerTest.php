<?php

namespace AppBundle\StringDivider;


use PHPUnit\Framework\TestCase;

class StringDividerTest extends TestCase
{

    public function test_divide_into_substrings()
    {
        $dividerRequest = new DividerRequest('abc', 1);
        $stringDivider = new StringDivider();
        $substringCollection = $stringDivider->divideIntoSubstrings($dividerRequest);

        $this->assertEquals([
            ['a', 'b', 'c'],
            ['ab', 'c'],
            ['a', 'bc'],
            ['abc']
        ], $substringCollection);
    }

    public function test_minimal_substring_length_equal_to_zero_throws_exception()
    {
        $this->expectException(\InvalidArgumentException::class);
        $dividerRequest = new DividerRequest('abc', 0);
        $stringDivider = new StringDivider();
        $stringDivider->divideIntoSubstrings($dividerRequest);
    }

    public function test_minimal_substring_length_smaller_than_zero_throws_exception()
    {
        $this->expectException(\InvalidArgumentException::class);
        $dividerRequest = new DividerRequest('abc', -1);
        $stringDivider = new StringDivider();
        $stringDivider->divideIntoSubstrings($dividerRequest);
    }
}