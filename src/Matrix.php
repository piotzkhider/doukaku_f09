<?php

namespace Acme;

class Matrix
{
    /**
     * @var array[]
     */
    private $value = [];

    /**
     * Matrix constructor.
     *
     * @param array[] $value
     */
    public function __construct(array $value)
    {
        $this->value = $value;
    }

    /**
     * @return array[]
     */
    public function value(): array
    {
        return $this->value;
    }
}
