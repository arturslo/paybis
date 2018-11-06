<?php

namespace AppBundle\StringDivider;

use Symfony\Component\Validator\Constraints as Assert;

class DividerRequest
{
    /**
     * @var string string to be divided
     */
    private $inputString;
    /**
     * @var int minaimal length of substring
     * @Assert\GreaterThan(0)
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

    /**
     * @param string $inputString
     */
    public function setInputString(?string $inputString): void
    {
        $this->inputString = $inputString;
    }

    /**
     * @param int $minimalSubstringLength
     */
    public function setMinimalSubstringLength(?int $minimalSubstringLength): void
    {
        $this->minimalSubstringLength = $minimalSubstringLength;
    }

}
