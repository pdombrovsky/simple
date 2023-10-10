<?php

namespace Expression\Operands\Contracts;

use Expression\Operands\Contracts\OperandProviderInterface;
use Expression\Operands\Value;

interface OperandValueProviderInterface extends OperandProviderInterface
{
    /**
     * @return Value[]
     */
    function getValues(): array;
}
