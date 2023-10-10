<?php

namespace Expression\Predicates\Contracts;

interface PredicatesChainInterface
{
    /**
     * @param PredicatesChainInterface $predicate
     * @return PredicatesChainInterface
     */
    function setNext(PredicatesChainInterface $predicate): PredicatesChainInterface;
}
