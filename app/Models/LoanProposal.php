<?php

namespace App\Models;

use InvalidArgumentException;

class LoanProposal
{
    private int $term;

    private float $amount;

    public function __construct(int $term, float $amount)
    {
        $this->setTerm($term);
        $this->setAmount($amount);
    }

    /**
     * @param int $term
     * 
     * @return void
     * 
     */
    private function setTerm(int $term): void
    {
        if (!in_array($term, [12, 24])) {
            throw new InvalidArgumentException('Invalid term');
        }

        $this->term = $term;
    }

    /**
     * @param float $amount
     * 
     * @return void
     * 
     */
    private function setAmount(float $amount): void
    {
        if ($amount < 1000 || $amount > 20000) {
            throw new InvalidArgumentException('Invalid amount');
        }

        $this->amount = round($amount, 2);
    }

    /**
     * Term (loan duration) for this loan application
     * in number of months.
     *
     * @return int
     * 
     */
    public function term(): int
    {
        return $this->term;
    }

    /**
     * Amount requested for this loan application
     * 
     * @return float
     * 
     */
    public function amount(): float
    {
        return $this->amount;
    }
}
