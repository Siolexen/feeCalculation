<?php

namespace Tests\Unit\Fee\Calculator;

use App\Fee\Calculator\FeeCalculator;
use App\Models\LoanProposal;
use Tests\TestCase;

class FeeCalculatorTest extends TestCase
{
    private $feeCalculator;

    public function __construct()
    {
        parent::__construct();
        $this->feeCalculator = new FeeCalculator;
    }

    public function testCalculation()
    {
        $loanProposalValues = [
            ['amount' => 11500, 'term' => 24, 'fee' => 460],
            ['amount' => 19250, 'term' => 12, 'fee' => 385],
            ['amount' => 1000, 'term' => 12, 'fee' => 50],
            ['amount' => 2000, 'term' => 12, 'fee' => 90],
            ['amount' => 3000, 'term' => 12, 'fee' => 90],
            ['amount' => 5500, 'term' => 12, 'fee' => 110],
            ['amount' => 20000, 'term' => 24, 'fee' => 800],
            ['amount' => 1500.43232, 'term' => 24, 'fee' => 85],
        ];

        foreach ($loanProposalValues as $key => $values) {
            $loanProposal = new LoanProposal($values['term'], $values['amount']);

            $this->assertEquals($this->feeCalculator->calculate($loanProposal), $values['fee']);
        }
    }
}
