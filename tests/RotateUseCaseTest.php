<?php

namespace Tests;

use Acme\Matrix;
use Acme\RotateResolver;
use Acme\RotateUseCase;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use stdClass;

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
        $action = $this->createPartialMock(stdClass::class, ['__invoke']);
        $action
            ->expects($this->once())
            ->method('__invoke')
            ->with($this->matrix)
            ->willReturn(new Matrix([]));

        $this->resolver
            ->expects($this->once())
            ->method('resolve')
            ->with('a')
            ->willReturn($action);

        $result = $this->SUT->run(['a']);

        $this->assertEquals(new Matrix([]), $result);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->matrix = $this->createMock(Matrix::class);
        $this->resolver = $this->createMock(RotateResolver::class);

        $this->SUT = new RotateUseCase($this->matrix, $this->resolver);
    }
}
