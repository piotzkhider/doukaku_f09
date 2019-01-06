<?php

namespace Acme;

use LogicException;

class ActionResolver
{
    /**
     * @var array|callable[]
     */
    private $actions = [];

    /**
     * @param string   $id
     * @param callable $action
     *
     * @return void
     */
    public function register(string $id, callable $action): void
    {
        $this->actions[$id] = $action;
    }

    /**
     * @param string $id
     *
     * @return callable
     */
    public function resolve(string $id): callable
    {
        if (! array_key_exists($id, $this->actions)) {
            throw new LogicException();
        }

        return $this->actions[$id];
    }
}
