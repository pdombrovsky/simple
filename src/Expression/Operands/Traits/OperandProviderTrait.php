<?php

namespace Expression\Operands\Traits;

use Expression\Operands\Contracts\OperandInterface;

use Expression\Operands\Operand;

trait OperandProviderTrait
{
    /**
     * @var Operand
     */
    private OperandInterface $operand;

    /**
     * @return Operand
     */
    public function getOperand(): Operand
    {
        return $this->operand;
    }
}
