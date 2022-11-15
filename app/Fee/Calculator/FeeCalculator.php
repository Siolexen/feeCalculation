<?php

namespace App\Fee\Calculator;

use App\Fee\Data\FeeData;
use App\Models\LoanProposal;

class FeeCalculator implements FeeCalculatorInteface
{
    private $feeData;

    /**
     * The calculated total fe 
     *
     * @param LoanProposal $application
     * 
     * @return float
     * 
     */
    public function calculate(LoanProposal $application): float
    {
        $feeData = new FeeData($application->term());
        $this->feeData = $feeData->data();

        return $this->roundUp($this->linearInterpolation($application));
    }

    /**
     * Linear interpolation calculation
     *
     * @param LoanProposal $application
     * 
     * @return float
     * 
     */
    private function linearInterpolation(LoanProposal $application): float 
    {

        if (isset($this->feeData[$application->amount()])) {
            return $this->feeData[$application->amount()];
        }

        $points = $this->getPoints($application->amount());

        $yp = $points['y0'] + (($points['y1'] - $points['y0']) / ($points['x1'] - $points['x0'])) * ($application->amount() - $points['x0']);

        return $yp;
    }

    /**
     * Search point to calculate interpolation  
     *
     * @param float $amount
     * 
     * @return array
     * 
     */
    private function getPoints(float $amount): array
    {
        $feeKeyfirst = 0;
        $feeKeysecond = 0;
        foreach ($this->feeData as $key => $fee) {
            if ($key < $amount) {
                $feeKeyfirst = $key;
            } else {
                $feeKeysecond = $key;
                break;
            }
        }

        return [
            'x0' => $feeKeyfirst, 'y0' => $this->feeData[$feeKeyfirst],
            'x1' => $feeKeysecond, 'y1' => $this->feeData[$feeKeysecond]
        ];
    }

    /**
     * Round Up
     *
     * @param mixed $n
     * @param int $x
     * 
     * @return int
     * 
     */
    private function roundUp($n, $x = 5): int
    {
        return (round($n) % $x === 0) ? round($n) : round(($n + $x / 2) / $x) * $x;
    }
}
