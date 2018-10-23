<?php

namespace AppBundle\StringDivider;

class StringDivider
{
    /**
     * @param DividerRequest $dividerRequest
     * @return array
     */
    public function divideIntoSubstrings($dividerRequest)
    {
        $stringLength = strlen($dividerRequest->getInputString());
        $substringCollection = [];

        for ($substringLength = $dividerRequest->getMinimalSubstringLength(); $substringLength <= $stringLength; $substringLength++) {
            $substringResult = [];
            for ($startIndex = 0; $startIndex < $stringLength; $startIndex += $substringLength) {
                $substring = substr($dividerRequest->getInputString(), $startIndex, $substringLength);

                if (strlen($substring) < $dividerRequest->getMinimalSubstringLength()) {
                    unset($substringResult);
                    continue 2;
                }

                $substringResult[] = substr($dividerRequest->getInputString(), $startIndex, $substringLength);
            }
            $substringCollection[] = $substringResult;
        }

        return $substringCollection;
    }
}