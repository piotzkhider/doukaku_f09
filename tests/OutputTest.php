<?php

namespace Tests;

use Acme\Matrix;
use Acme\Output;
use PHPUnit\Framework\TestCase;
use stdClass;

class OutputTest extends TestCase
{
    public function testWriteln()
    {
        $matrix = new Matrix([
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9],
        ]);

        $format = $this->createPartialMock(stdClass::class, ['__invoke']);
        $format
            ->expects($this->once())
            ->method('__invoke')
            ->with($matrix)
            ->willReturn('formatted');

        $output = new Output();

        $this->expectOutputString('formatted'.PHP_EOL);

        $output->writeln($matrix, $format);
    }
}
