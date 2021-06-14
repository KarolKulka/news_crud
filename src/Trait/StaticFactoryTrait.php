<?php
declare(strict_types = 1);

namespace App\Trait;

trait StaticFactoryTrait
{
    /**
     * Static method for instantiating current class
     *
     * @return static
     */
    public static function create(): self
    {
        return new static();
    }
}
