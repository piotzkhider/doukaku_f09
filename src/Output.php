<?php

namespace Acme;

class Output
{
    /**
     * @param Matrix        $matrix
     * @param callable|null $format
     *
     * @return void
     */
    public function writeln(Matrix $matrix, callable $format): void
    {
        echo $format($matrix), PHP_EOL;
    }
}
