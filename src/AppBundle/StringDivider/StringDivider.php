<?php

namespace AppBundle\StringDivider;

class StringDivider
{
    /**
     * @param DividerRequest $dividerRequest
     * @return array[][]
     */
    public function divideIntoSubstrings($dividerRequest)
    {
        $this->validate($dividerRequest);

        $stringLength = strlen($dividerRequest->getInputString());
        $maxArrayElementCount = intdiv($stringLength, $dividerRequest->getMinimalSubstringLength());

        $lock = new SubstringLengthGenerator($maxArrayElementCount, $stringLength);
        $substringLengthCollection = $lock->getSubstringLengthCollection();

        $substringCollection = [];
        foreach ($substringLengthCollection as $substringLengthArray) {
            $substringArray = [];
            $startIndex = 0;
            foreach ($substringLengthArray as $substringLength) {
                $substringArray[] = substr($dividerRequest->getInputString(), $startIndex, $substringLength);
                $startIndex += $substringLength;
            }
            $substringCollection[] = $substringArray;
        }

        return $substringCollection;
    }

    public function validate(DividerRequest $dividerRequest)
    {
        if ($dividerRequest->getMinimalSubstringLength() <= 0) {
            throw new \InvalidArgumentException('minimal substring length must be larger than 0');
        }
    }

}
