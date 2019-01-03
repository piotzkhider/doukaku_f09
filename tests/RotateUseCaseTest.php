<?php

namespace Tests;

use Acme\Matrix;
use Acme\RotateResolver;
use Acme\RotateUseCase;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RotateUseCaseTest extends TestCase
{
    /**
     * @var Matrix|MockObject
     */
    private $matrix;

    /**
     * @var RotateResolver|MockObject
     */
    private $resolver;

    /**
     * @var RotateUseCase
     */
    private $SUT;

    public function testRun()
    {
        $this->resolver
            ->expects($this->once())
            ->method('resolve')
            ->with('a')
            ->willReturn(function (Matrix $matrix) {
                return $matrix;
            });

        $result = $this->SUT->run(['a']);

        $this->assertEquals($this->matrix, $result);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->matrix = $this->createMock(Matrix::class);
        $this->resolver = $this->createMock(RotateResolver::class);

        $this->SUT = new RotateUseCase($this->matrix, $this->resolver);
    }
}
