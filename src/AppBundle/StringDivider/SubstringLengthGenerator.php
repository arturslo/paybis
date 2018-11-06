<?php

namespace AppBundle\StringDivider;


class SubstringLengthGenerator
{
    private $currentCombination = [];
    private $combinationCollection = [];
    private $maxArrayElementCount;
    private $minNumber = 0;
    private $maxNumber;
    private $currentLevel;
    private $currentNumber;
    private $lastIndex;
    private $substringLengthCollection = [];

    public function __construct(int $maxArrayElementCount, int $maxNumber)
    {
        $this->maxArrayElementCount = $maxArrayElementCount;
        $this->maxNumber = $maxNumber;

        $this->lastIndex = $this->maxArrayElementCount - 1;
        $this->currentNumber = $this->minNumber;
        $this->currentLevel = $this->minNumber;
        for ($index = 0; $index < $this->maxArrayElementCount; $index++) {
            $this->currentCombination[$index] = $this->minNumber;
        }
        $this->combinationCollection[] = $this->currentCombination;

        while ($this->next()) ;

        $resultArray1 = [];
        foreach ($this->combinationCollection as $row) {
            $rowSum = 0;
            foreach ($row as $col) {
                $rowSum += $col;
            }
            if ($rowSum === $this->maxNumber) {
                $resultArray1[] = $row;
            }
        }

        $resultArray2 = [];
        foreach ($resultArray1 as $row) {
            $newRow = [];
            foreach ($row as $col) {
                if ($col === 0) {
                    continue;
                }
                $newRow[] = $col;
            }
            $resultArray2[] = $newRow;
        }

        $this->substringLengthCollection = array_unique($resultArray2, SORT_REGULAR);
    }

    public function allNumbersMatchCurrentLevel()
    {
        $match = true;
        foreach ($this->currentCombination as $number) {
            if ($number !== $this->currentLevel) {
                $match = false;
                break;
            }
        }
        return $match;
    }

    public function increaseLevel()
    {

        $this->currentCombination[0] = $this->currentLevel;
        foreach ($this->currentCombination as $index => $value) {
            if ($index === 0) {
                continue;
            }
            $this->currentCombination[$index] = $this->minNumber;
        }
        $this->currentNumber = $this->minNumber + 1;
        $this->combinationCollection[] = $this->currentCombination;
    }

    public function next()
    {
        if ($this->allNumbersMatchCurrentLevel()) {
            $this->currentLevel++;
            if ($this->currentLevel > $this->maxNumber) {
                return false;
            }
            $this->increaseLevel();
            return true;
        }

        for ($index = $this->lastIndex; $index >= 0; $index--) {
            if ($index === 0) {
                $this->currentNumber++;
                $index = $this->lastIndex;
            }
            if ($this->currentCombination[$index] != $this->currentNumber) {
                $this->currentCombination[$index] = $this->currentCombination[$index] + 1;
                $this->combinationCollection[] = $this->currentCombination;
                $this->combinationCollection[] = array_reverse($this->currentCombination);
                return true;

            }
        }

        return false;
    }

    /**
     * @return array[][]
     */
    public function getSubstringLengthCollection(): array
    {
        return $this->substringLengthCollection;
    }

}
