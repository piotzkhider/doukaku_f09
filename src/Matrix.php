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

    /**
     * @return string
     */
    public function __toString(): string
    {
        $reduced = array_reduce($this->value, function (array $carry, array $item) {
            $carry[] = implode($item);

            return $carry;
        }, []);

        return implode('/', $reduced);
    }
}
