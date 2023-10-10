<?php

namespace Expression\Predicates;

use Expression\Predicates\Contracts\StringPredicatesChainInterface;

use Expression\Predicates\Traits\StringPredicatesChainTrait;

class BeginsWithDigitPredicate implements StringPredicatesChainInterface
{
    use StringPredicatesChainTrait;

    /**
     * @param string $value
     * @return bool
     */
    public function __invoke(string $value): bool
    {
        if (preg_match('/(^\d|\.\d|\]\d)/', $value) === 1)
            return true;

        return $this->invokeNext($value);
    }
}
