<?php

namespace Acme;

use LogicException;

class RotateResolver
{
    /**
     * @var array|callable[]
     */
    private $callbacks = [];

    /**
     * @param string   $command
     * @param callable $callback
     *
     * @return void
     */
    public function register(string $command, callable $callback): void
    {
        $this->callbacks[$command] = $callback;
    }

    /**
     * @param string $command
     *
     * @return callable
     */
    public function resolve(string $command): callable
    {
        if (! array_key_exists($command, $this->callbacks)) {
            throw new LogicException();
        }

        return $this->callbacks[$command];
    }
}
