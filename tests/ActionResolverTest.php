<?php

namespace Tests;

use Acme\ActionResolver;
use LogicException;
use PHPUnit\Framework\TestCase;

class ActionResolverTest extends TestCase
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
     * @var ActionResolver
     */
    private $SUT;

    protected function setUp()
    {
        parent::setUp();

        $this->SUT = new ActionResolver();
    }
}
