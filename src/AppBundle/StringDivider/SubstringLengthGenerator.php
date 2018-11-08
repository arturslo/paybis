<?php

namespace AppBundle\StringDivider;


class SubstringLengthGenerator
{

    private $maxArrayElementCount;
    private $minNumber;
    private $maxNumber;


    public function __construct(int $maxArrayElementCount, int $maxNumber, int $minNumber)
    {
        $this->maxArrayElementCount = $maxArrayElementCount;
        $this->maxNumber = $maxNumber;
        $this->minNumber = $minNumber;

    }

}
