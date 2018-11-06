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

}
