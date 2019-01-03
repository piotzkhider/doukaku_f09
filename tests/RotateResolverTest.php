<?php

namespace Tests;

use Acme\RotateResolver;
use LogicException;
use PHPUnit\Framework\TestCase;

class RotateResolverTest extends TestCase
{
    public function testResolve_登録されていないコマンド()
    {
        $this->expectException(LogicException::class);

        $this->SUT->resolve('a');
    }

    public function testResolve_登録されているコマンド()
    {
        $command = function () {
        };

        $this->SUT->register('a', $command);

        $this->assertEquals($command, $this->SUT->resolve('a'));
    }

    /**
     * @var RotateResolver
     */
    private $SUT;

    protected function setUp()
    {
        parent::setUp();

        $this->SUT = new RotateResolver();
    }
}
