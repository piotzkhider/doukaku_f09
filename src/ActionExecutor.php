<?php

namespace Acme;

class ActionExecutor
{
    /**
     * @var Matrix
     */
    private $matrix;

    /**
     * @var ActionResolver
     */
    private $resolver;

    /**
     * ActionExecutor constructor.
     *
     * @param Matrix         $matrix
     * @param ActionResolver $resolver
     */
    public function __construct(Matrix $matrix, ActionResolver $resolver)
    {
        $this->matrix = $matrix;
        $this->resolver = $resolver;
    }

    /**
     * @param array|string[] $ids
     *
     * @return Matrix
     */
    public function execute(array $ids): Matrix
    {
        return array_reduce($ids, function (Matrix $matrix, string $id) {
            $action = $this->resolver->resolve($id);

            return $action($matrix);
        }, $this->matrix);
    }
}
