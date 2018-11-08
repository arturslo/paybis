<?php

namespace AppBundle\StringDivider;


class Set
{
    /**
     * @var array
     */
    private $numbers = [];
    /**
     * @var int
     */
    private $currentIndex = 0;
    /**
     * @var int
     */
    private $lastIndex;

    /**
     * Set constructor.
     * @param array $numbers
     */
    public function __construct(array $numbers)
    {
        $this->numbers = $numbers;
        $this->lastIndex = count($numbers) - 1;
    }

    /**
     * @return bool
     */
    public function hasNext()
    {
        if ($this->currentIndex >= $this->lastIndex) {
            return false;
        }

        return true;
    }

    /**
     * increase current index by 1
     */
    public function next()
    {
        if ($this->currentIndex === $this->lastIndex) {
            throw new \LogicException('set iterator already on last index');
        }

        $this->currentIndex++;
    }

    /**
     * set current index to 0
     */
    public function resetIndex()
    {
        $this->currentIndex = 0;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->numbers[$this->currentIndex];
    }

}
