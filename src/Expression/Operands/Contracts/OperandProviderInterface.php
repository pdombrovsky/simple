<?php

namespace Expression\Operands\Contracts;

interface OperandProviderInterface
{
    /**
     * @return OperandInterface
     */
    function getOperand(): OperandInterface;
}
