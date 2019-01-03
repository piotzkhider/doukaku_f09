<?php

namespace Tests;

use Acme\Matrix;
use PHPUnit\Framework\TestCase;

class MatrixTest extends TestCase
{
    public function test__toString()
    {
        $matrix = new Matrix([
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9],
        ]);

        $this->assertEquals('123/456/789', (string) $matrix);
    }
}
