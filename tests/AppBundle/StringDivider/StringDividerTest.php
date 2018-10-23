<?php

namespace AppBundle\StringDivider;


use PHPUnit\Framework\TestCase;

class StringDividerTest extends TestCase
{

    public function testDivideIntoSubstrings()
    {
        $inputString = 'abc';
        $minimalSubstringLength = 1;

        $dividerRequest = new DividerRequest($inputString, $minimalSubstringLength);
        $stringDivider = new StringDivider();
        $substringCollection = $stringDivider->divideIntoSubstrings($dividerRequest);

        $this->assertEquals([
            ['a', 'b', 'c'],
            ['ab', 'c'],
            ['abc']
        ], $substringCollection);
    }

}