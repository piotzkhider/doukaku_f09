<?php

namespace Acme;

class ActionUseCase
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
     * ActionUseCase constructor.
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
    public function run(array $ids): Matrix
    {
        return array_reduce($ids, function (Matrix $matrix, string $id) {
            $action = $this->resolver->resolve($id);

            return $action($matrix);
        }, $this->matrix);
    }
}
