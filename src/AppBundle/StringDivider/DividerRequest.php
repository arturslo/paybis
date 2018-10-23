<?php

namespace AppBundle\StringDivider;

class DividerRequest
{
    /**
     * @var string string to be divided
     */
    private $inputString;
    /**
     * @var int minaimal length of substring
     */
    private $minimalSubstringLength;

    /**
     * DividerRequest constructor.
     * @param string $inputString
     * @param int $minimalSubstringLength
     */
    public function __construct(string $inputString, int $minimalSubstringLength)
    {
        $this->inputString = $inputString;
        $this->minimalSubstringLength = $minimalSubstringLength;
    }

    /**
     * @return string
     */
    public function getInputString(): string
    {
        return $this->inputString;
    }

    /**
     * @return int
     */
    public function getMinimalSubstringLength(): int
    {
        return $this->minimalSubstringLength;
    }

}
