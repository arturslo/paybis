<?php

namespace AppBundle\StringDivider;

class StringDivider
{
    /**
     * @var ProductGenerator
     */
    private $productGenerator;

    /**
     * @var ProductCollectionFilter
     */
    private $productCollectionFilter;

    /**
     * StringDivider constructor.
     * @param ProductGenerator $productGenerator
     * @param ProductCollectionFilter $productCollectionFilter
     */
    public function __construct(ProductGenerator $productGenerator, ProductCollectionFilter $productCollectionFilter)
    {
        $this->productGenerator = $productGenerator;
        $this->productCollectionFilter = $productCollectionFilter;
    }

    /**
     * @param int $minDivider
     * @param int $maxDivider
     * @return array
     */
    private function getPossibleDividers(int $minDivider, int $maxDivider)
    {
        $dividers = [];
        for ($divider = $minDivider; $divider <= $maxDivider; $divider++) {
            $dividers[] = $divider;
        }

        return $dividers;
    }

    /**
     * @param array $dividers
     * @return SetCollection[]
     */
    private function getDividerSetCollections(array $dividers)
    {
        $setCollections = [];
        for ($setCount = count($dividers); $setCount >= 1; $setCount--) {
            $setArray = [];
            for ($step = 1; $step <= $setCount; $step++) {
                $setArray[] = new Set($dividers);
            }
            $setCollections[] = new SetCollection($setArray);
        }

        return $setCollections;
    }

    /**
     * @param SetCollection[]
     * @return ProductCollection
     */
    private function getProductCollection(array $setCollections)
    {
        $productsArray = [];
        foreach ($setCollections as $setCollection) {
            $this->productGenerator->loadSetCollection($setCollection);
            $productsArray[] = $this->productGenerator->getProduct();
        }

        return new ProductCollection($productsArray);
    }

    /**
     * @param DividerRequest $dividerRequest
     * @return array[][]
     */
    public function divideIntoSubstrings($dividerRequest)
    {
        $this->validate($dividerRequest);

        $stringLength = strlen($dividerRequest->getInputString());

        if ($stringLength === 0) {
            return [];
        }

        if ($dividerRequest->getMinimalSubstringLength() > $stringLength) {
            return [];
        }

        $dividers = $this->getPossibleDividers($dividerRequest->getMinimalSubstringLength(), $stringLength);
        $setCollections = $this->getDividerSetCollections($dividers);
        $productCollection = $this->getProductCollection($setCollections);
        $substringLengthCollection = $this->productCollectionFilter->filter($productCollection, $stringLength);

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
