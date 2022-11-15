<?php

namespace Tests\Unit\Fee\Calculator;

use App\Models\LoanProposal;
use InvalidArgumentException;
use Tests\TestCase;

class LoanProposalTest extends TestCase
{
    public function testValidationDataMaximumAmount()
    {
        $this->expectException(InvalidArgumentException::class);
        new LoanProposal(12, 22000);
    }

    public function testValidationDataMinimalAmount()
    {
        $this->expectException(InvalidArgumentException::class);
        new LoanProposal(12, 500);
    }


    public function testValidationDataTerm()
    {
        $this->expectException(InvalidArgumentException::class);
        new LoanProposal(15, 2000);
    }

    public function testValidationDataPass()
    {
        $loanProposal = new LoanProposal(12, 2000);
        $this->assertInstanceOf(LoanProposal::class, $loanProposal);
    }
}
