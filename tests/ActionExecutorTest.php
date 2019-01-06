<?php

namespace Tests;

use Acme\ActionExecutor;
use Acme\ActionResolver;
use Acme\Matrix;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use stdClass;

class ActionExecutorTest extends TestCase
{
    /**
     * @var Matrix|MockObject
     */
    private $matrix;

    /**
     * @var ActionResolver|MockObject
     */
    private $resolver;

    /**
     * @var ActionExecutor
     */
    private $SUT;

    public function testExecute()
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

        $result = $this->SUT->execute(['a']);

        $this->assertEquals(new Matrix([]), $result);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->matrix = $this->createMock(Matrix::class);
        $this->resolver = $this->createMock(ActionResolver::class);

        $this->SUT = new ActionExecutor($this->matrix, $this->resolver);
    }
}
