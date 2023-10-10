<?php

namespace Expression\Conditions\Functions;

use Expression\Operands\Contracts\OperandInterface;

use Expression\Operands\Traits\OperandProviderTrait;

class Size implements OperandInterface
{
    use OperandProviderTrait;

    /**
     * @param OperandInterface $operandInterface
     */
    public function __construct(OperandInterface $operandInterface)
    {
        $this->operand = $operandInterface;
    }

    /**
     * @return string
     */
    public function evaluate(): string
    {
        return "size({$this->operand->evaluate()})";
    }
}
