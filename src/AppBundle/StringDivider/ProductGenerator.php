<?php

namespace AppBundle\StringDivider;

class ProductGenerator
{
    /**
     * @var SetCollection
     */
    private $setCollection;
    /**
     * @var int
     */
    private $lastSetIndex;
    /**
     * @var int
     */
    private $setSelectorIndex1;
    /**
     * @var int
     */
    private $setSelectorIndex2;
    /**
     * @var bool
     */
    private $firstIteration;

    /**
     * ProductGenerator constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param SetCollection $setCollection
     */
    public function loadSetCollection(SetCollection $setCollection)
    {
        $this->setCollection = $setCollection;
        $this->lastSetIndex = count($setCollection) - 1;
        $this->setSelectorIndex1 = $this->lastSetIndex;
        $this->setSelectorIndex2 = $this->lastSetIndex;
        $this->firstIteration = true;
    }

    /**
     * @return array
     */
    private function getSetValues()
    {
        $values = [];
        foreach ($this->setCollection as $set) {
            $values[] = $set->getValue();
        }

        return $values;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        $combinations = [];
        while ($combination = $this->next()) {
            $combinations[] = $combination;
        }

        return new Product($combinations);
    }

    /**
     * Returns next generated value
     * or false when no iteration is possible
     * @return array|bool
     */
    private function next()
    {
        if ($this->firstIteration) {
            $this->firstIteration = false;

            return $this->getSetValues();
        }

        if (false === $this->isSelector2AtRowEnd()) {
            $this->setCollection[$this->setSelectorIndex2]->next();

            return $this->getSetValues();
        }

        while ($this->isSelector2AtRowEnd() && $this->setSelectorIndex1 < $this->setSelectorIndex2) {
            $this->decreaseSetSelectorIndex2();
        }

        if ($this->areSelectorsOnSameRow()) {
            if (
                $this->setSelectorIndex1 === 0
                && $this->isSelector1AtRowEnd()
                && $this->isSelector2AtRowEnd()
            ) {
                return false;
            }

            if ($this->isSelector1AtRowEnd()) {
                $this->decreaseSetSelectorIndex1();
            }

            $this->setCollection[$this->setSelectorIndex1]->next();
            $this->resetSetSelectorIndex2();
            $this->resetIndexesBelowSetSelector1();
            return $this->getSetValues();
        }

        if (false === $this->areSelectorsOnSameRow()) {
            $this->setCollection[$this->setSelectorIndex2]->next();
            $this->resetIndexesBelowSetSelector2();
            $this->resetSetSelectorIndex2();

            return $this->getSetValues();
        }

        return false;
    }

    /**
     * @return bool
     */
    private function areSelectorsOnSameRow()
    {
        return $this->setSelectorIndex1 === $this->setSelectorIndex2;
    }

    /**
     * @return bool
     */
    private function isSelector1AtRowEnd()
    {
        return ($this->setCollection[$this->setSelectorIndex1]->hasNext()) ? false : true;
    }

    /**
     * @return bool
     */
    private function isSelector2AtRowEnd()
    {
        return ($this->setCollection[$this->setSelectorIndex2]->hasNext()) ? false : true;
    }

    private function decreaseSetSelectorIndex1()
    {
        $this->setSelectorIndex1--;
    }

    private function decreaseSetSelectorIndex2()
    {
        $this->setSelectorIndex2--;
    }

    private function resetSetSelectorIndex2()
    {
        $this->setSelectorIndex2 = $this->lastSetIndex;
    }

    private function resetIndexesBelowSetSelector1()
    {
        for ($setIndex = $this->setSelectorIndex1 + 1; $setIndex <= $this->lastSetIndex; $setIndex++) {
            $this->setCollection[$setIndex]->resetIndex();
        }
    }

    private function resetIndexesBelowSetSelector2()
    {
        for ($setIndex = $this->setSelectorIndex2 + 1; $setIndex <= $this->lastSetIndex; $setIndex++) {
            $this->setCollection[$setIndex]->resetIndex();
        }
    }

}
