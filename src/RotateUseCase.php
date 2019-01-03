<?php

namespace Acme;

class RotateUseCase
{
    /**
     * @var Matrix
     */
    private $matrix;

    /**
     * @var RotateResolver
     */
    private $resolver;

    /**
     * RotateUseCase constructor.
     *
     * @param Matrix         $matrix
     * @param RotateResolver $resolver
     */
    public function __construct(Matrix $matrix, RotateResolver $resolver)
    {
        $this->matrix = $matrix;
        $this->resolver = $resolver;
    }

    /**
     * @param array $commands
     *
     * @return Matrix
     */
    public function run(array $commands): Matrix
    {
        return array_reduce($commands, function (Matrix $matrix, string $command) {
            $rotate = $this->resolver->resolve($command);

            return $rotate($matrix);
        }, $this->matrix);
    }
}
