<?php

namespace Expression\Operands\Contracts;

interface OperandsCollectionInterface
{
    /**
     * @return OperandValueProviderInterface[]
     */
    function getOperands(): array;
}
