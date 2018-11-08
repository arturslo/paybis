<?php

namespace AppBundle\StringDivider;


class ProductCollectionFilter
{
    /**
     * @param ProductCollection $productCollection
     * @param int $stringLength
     * @return array[][]
     */
    public function filter(ProductCollection $productCollection, int $stringLength)
    {
        $filteredCombinations = [];
        foreach ($productCollection as $product) {
            foreach ($product as $combinations) {
                if (array_sum($combinations) === $stringLength) {
                    $filteredCombinations[] = $combinations;
                }
            }
        }

        return $filteredCombinations;
    }
}