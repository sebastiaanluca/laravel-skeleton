<?php

declare(strict_types=1);

namespace Tests\Concerns;

trait Asserts
{
    /**
     * Assert each item in a collection is equal to the given value.
     *
     * @param iterable $array
     * @param mixed $value
     */
    public static function assertEachEquals(iterable $array, $value) : void
    {
        foreach ($array as $item) {
            static::assertEquals($value, $item);
        }
    }

    /**
     * Assert each item in a collection is the given value.
     *
     * @param iterable $array
     * @param mixed $value
     */
    public static function assertEachSame(iterable $array, $value) : void
    {
        foreach ($array as $item) {
            static::assertSame($value, $item);
        }
    }

    /**
     * Asserts that two variables are equal regardless of their order.
     *
     * @param mixed $expected
     * @param mixed $actual
     * @param string $message
     */
    public static function assertSameValues($expected, $actual, string $message = '') : void
    {
        static::assertEqualsCanonicalizing(
            $expected,
            $actual,
            $message
        );
    }
}
