<?php

require_once 'vendor/autoload.php';

use Acme\Matrix;
use Acme\RotateResolver;
use Acme\RotateUseCase;

/**
 * @param array[] $matrix
 *
 * @return array[]|array
 */
function transpose(array $matrix): array
{
    return array_map(null, ...$matrix);
}

$matrix = new Matrix([
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9],
]);

$resolver = new RotateResolver();

$resolver->register('a', function (Matrix $matrix) {
    $matrixValue = $matrix->value();

    $infinite = new InfiniteIterator(new ArrayIterator($matrixValue[0]));
    $limit = new LimitIterator($infinite, 1, 3);
    $matrixValue[0] = iterator_to_array($limit);

    return new Matrix($matrixValue);
});

$resolver->register('e', function (Matrix $matrix) {
    $transposed = transpose($matrix->value());

    $infinite = new InfiniteIterator(new ArrayIterator($transposed[1]));
    $limit = new LimitIterator($infinite, 2, 3);
    $transposed[1] = iterator_to_array($limit);

    return new Matrix(transpose($transposed));
});

$useCase = new RotateUseCase($matrix, $resolver);

$input = trim(fgets(STDIN));

$matrix = $useCase->run(str_split($input));

echo $matrix, PHP_EOL;

//const COMMANDS = [
//    'a' => [1, 2, 0, 3, 4, 5, 6, 7, 8],
//    'b' => [0, 1, 2, 4, 5, 3, 6, 7, 8],
//    'c' => [0, 1, 2, 3, 4, 5, 7, 8, 6],
//    'd' => [6, 1, 2, 0, 4, 5, 3, 7, 8],
//    'e' => [0, 7, 2, 3, 1, 5, 6, 4, 8],
//    'f' => [0, 1, 8, 3, 4, 2, 6, 7, 5],
//    'g' => [0, 1, 2, 3, 4, 5, 8, 6, 7],
//    'h' => [0, 1, 2, 5, 3, 4, 6, 7, 8],
//    'i' => [2, 0, 1, 3, 4, 5, 6, 7, 8],
//    'j' => [0, 1, 5, 3, 4, 8, 6, 7, 2],
//    'k' => [0, 4, 2, 3, 7, 5, 6, 1, 8],
//    'l' => [3, 1, 2, 6, 4, 5, 0, 7, 8],
////];
//
//$xs = [1, 2, 3, 4, 5, 6, 7, 8, 9];
//
//$input = trim(fgets(STDIN));
//
//foreach (str_split($input) as $order) {
//    $rule = array_fill_keys(COMMANDS[$order], null);
//    $xs = array_values(array_replace($rule, $xs));
//}
//
//echo implode(str_split(implode($xs), 3), '/'), PHP_EOL;
