<?php

namespace AppBundle\StringDivider;

use PHPUnit\Framework\TestCase;

class ProductGeneratorTest extends TestCase
{
    public function getSetCollection(int $fromNumber, int $toNumber)
    {
        $numbers = [];
        for ($number = $fromNumber; $number <= $toNumber; $number++) {
            $numbers[] = $number;
        }

        $sets = [];
        foreach ($numbers as $_) {
            $sets[] = new Set($numbers);
        }

        return new SetCollection($sets);
    }

    public function test_product_result_1()
    {
        $setArray = [];
        $setArray[] = new Set([1, 2]);
        $setArray[] = new Set([1, 2]);
        $setArray[] = new Set([1, 2]);

        $setCollection = new SetCollection($setArray);

        $productGenerator = new ProductGenerator($setCollection);
        $product = $productGenerator->getProduct();

        $this->assertEquals(new Product([
            [1, 1, 1],
            [1, 1, 2],
            [1, 2, 1],
            [1, 2, 2],
            [2, 1, 1],
            [2, 1, 2],
            [2, 2, 1],
            [2, 2, 2]
        ]), $product);
    }

    public function test_product_result_2()
    {
        $setCollection = $this->getSetCollection(1, 2);

        $productGenerator = new ProductGenerator($setCollection);
        $product = $productGenerator->getProduct();

        $this->assertEquals(new Product([
            [1, 1],
            [1, 2],
            [2, 1],
            [2, 2]
        ]), $product);
    }
}