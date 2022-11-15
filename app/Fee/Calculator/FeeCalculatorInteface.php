<?php

namespace App\Fee\Calculator;

use App\Models\LoanProposal;

interface FeeCalculatorInteface
{
    /**
     * @return float The calculated total fee.
     */
    public function calculate(LoanProposal $application): float;
}
