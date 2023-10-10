<?php

namespace Expression\Predicates;

use Expression\Predicates\Contracts\StringPredicatesChainInterface;

use Expression\Predicates\Traits\StringPredicatesChainTrait;

class HasSpecialCharsPredicate implements StringPredicatesChainInterface
{
    use StringPredicatesChainTrait;

    private const SPECIAL_CHARS = ['-', ' ', '.'];

    public function __invoke(string $value): bool
    {
        $pattern = '/[' . preg_quote(implode('', static::SPECIAL_CHARS), '/') . ']/';
        if (preg_match($pattern, $value) === 1)
            return true;

        return $this->invokeNext($value);
    }
}
