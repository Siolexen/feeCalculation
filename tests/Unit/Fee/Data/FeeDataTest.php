<?php

namespace Tests\Unit\Fee\Data;

use App\Fee\Data\FeeData;
use InvalidArgumentException;
use Tests\TestCase;

class FeeDataTest extends TestCase
{
    public function testValidationWrongData()
    {
        $this->expectException(InvalidArgumentException::class);
        new FeeData(13);
    }

    public function testValidationDataPass()
    {
        $feeData = new FeeData(12);
        $this->assertInstanceOf(FeeData::class, $feeData);

        $this->assertIsArray($feeData->data());
    }
}
