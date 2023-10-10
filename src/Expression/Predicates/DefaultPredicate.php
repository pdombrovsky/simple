<?php

namespace Expression\Predicates;

use Expression\Predicates\Contracts\StringPredicateInterface;

class DefaultPredicate implements StringPredicateInterface
{
    /**
     * @param bool $default
     */
    public function __construct(private bool $default)
    {
    }

    /**
     * @param string $value
     * @return bool
     */
    public function __invoke(string $value): bool
    {
        return $this->default;
    }
}
