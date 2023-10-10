<?php

namespace Expression\Predicates\Traits;

use Expression\Predicates\Contracts\PredicatesChainInterface;

trait StringPredicatesChainTrait
{
    /**
     * @var PredicatesChainInterface|null
     */
    private ?PredicatesChainInterface $nextPredicate = null;

    /**
     * @param PredicatesChainInterface $predicate
     * @return PredicatesChainInterface
     */
    public function setNext(PredicatesChainInterface $predicate): PredicatesChainInterface
    {
        return $this->nextPredicate = $predicate;
    }

    /**
     * @param string $value
     * @return bool
     */
    protected function invokeNext(string $value): bool
    {
        if ($this->nextPredicate) {
            return ($this->nextPredicate)($value);
        }

        return false;
    }
}
