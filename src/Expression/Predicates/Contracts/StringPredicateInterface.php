<?php

namespace Expression\Predicates\Contracts;

interface StringPredicateInterface
{
    /**
     * @param string $value
     * @return bool
     */
    function __invoke(string $value): bool;
}
