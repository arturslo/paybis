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

    public function test_empty_string_return_empty_array()
    {
        $dividerRequest = new DividerRequest('', 1);
        $stringDivider = new StringDivider();
        $substringCollection = $stringDivider->divideIntoSubstrings($dividerRequest);

        $this->assertEquals([], $substringCollection);
    }

    public function test_one_element_string_with_minimal_substring_1()
    {
        $dividerRequest = new DividerRequest('a', 1);
        $stringDivider = new StringDivider();
        $substringCollection = $stringDivider->divideIntoSubstrings($dividerRequest);

        $this->assertEquals([['a']], $substringCollection);
    }

    public function test_2_element_string_min_divider_1()
    {
        $dividerRequest = new DividerRequest('ab', 1);
        $stringDivider = new StringDivider();
        $substringCollection = $stringDivider->divideIntoSubstrings($dividerRequest);

        $this->assertEquals([['a', 'b'], ['ab']], $substringCollection);
    }

    public function test_min_substring_larger_than_string_element_count_returns_empty_array()
    {
        $dividerRequest = new DividerRequest('ab', 6);
        $stringDivider = new StringDivider();
        $substringCollection = $stringDivider->divideIntoSubstrings($dividerRequest);

        $this->assertEquals([], $substringCollection);
    }

    public function test_divide_into_substrings_diffrent_chars()
    {
        $dividerRequest = new DividerRequest('xyz', 1);
        $stringDivider = new StringDivider();
        $substringCollection = $stringDivider->divideIntoSubstrings($dividerRequest);

        $this->assertEquals([
            ['x', 'y', 'z'],
            ['xy', 'z'],
            ['x', 'yz'],
            ['xyz']
        ], $substringCollection);
    }

    public function test_4_element_string_min_substring_2()
    {
        $dividerRequest = new DividerRequest('abcd', 2);
        $stringDivider = new StringDivider();
        $substringCollection = $stringDivider->divideIntoSubstrings($dividerRequest);

        $this->assertEquals([
            ['ab', 'cd'],
            ['abcd']
        ], $substringCollection);
    }
}
