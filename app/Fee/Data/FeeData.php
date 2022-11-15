<?php

namespace App\Fee\Data;

use InvalidArgumentException;

class FeeData
{
    private $data;

    public function __construct(int $term)
    {
        $this->setFeeData($term);
    }

    /**
     * @param int $term
     * 
     * @return void
     * 
     */
    private function setFeeData(int $term): void
    {
        if (!isset(config('fee')[$term])) {
            throw new InvalidArgumentException('Invalid term');
        }
    
        $this->data = config('fee')[$term];
    }

    /**
     * @return array
     * 
     */
    public function data(): array
    {
        return $this->data;
    }
}
