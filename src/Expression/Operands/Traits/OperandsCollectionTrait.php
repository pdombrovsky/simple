<?php

namespace Expression\Operands\Traits;

use Expression\Operands\Contracts\OperandValueProviderInterface;

trait OperandsCollectionTrait
{
    /**
     * @return OperandValueProviderInterface[]
     */
    public function getOperands(): array
    {
        return [$this];
    }
}
