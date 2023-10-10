<?php

namespace Expression\Conditions\Traits;

use Expression\Operands\Contracts\OperandInterface;

trait OperandProviderTrait
{
    /**
     * @var OperandInterface
     */
    private OperandInterface $operandInterface;

    /**
     * @return OperandInterface
     */
    public function getOperand(): OperandInterface
    {
        return $this->operandInterface->getOperand();
    }
}
