<?php

namespace App\Http\Controllers;

use App\Fee\Calculator\FeeCalculator;
use App\Models\LoanProposal;

class TestController extends Controller
{
    public function index(){
        $calculator = new FeeCalculator;

        $application = new LoanProposal(24, 1500);
        $fee = $calculator->calculate($application);

        echo $fee;
    }
}
