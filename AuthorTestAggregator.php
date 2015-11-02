<?php

namespace PhpBeast;

/*
 * LingTalfi 2015-11-02
 */
class AuthorTestAggregator extends TestAggregator
{


    /**
     *
     * a: array of values to test
     * b: array of expected values
     *
     * a and b must have same length.
     *
     *
     * bool     f ( mixed:value, mixed:expected, &str:msg=null )
     *
     * See addTest method for more details.
     *
     */
    public function addTestsByColumn(array $a, array $b, callable $f)
    {
        $n = count($a);
        if ($n === count($b)) {
            for ($i = 0; $i < $n; $i++) {
                $value = array_shift($a);
                $expected = array_shift($b);
                $this->addTest(function (&$msg) use ($value, $expected, $f) {
                    return call_user_func_array($f, [$value, $expected, &$msg]);
                });
            }
        }
        else {
            throw new \Exception(sprintf("Array a and b must have same length (a=%d, b=%d)", $n, count($b)));
        }
    }


}
