<?php

namespace Expression\Conditions\Functions;

use Expression\Contracts\ExpressionableInterface;
use Expression\Operands\Contracts\OperandInterface;
use Expression\Operands\Contracts\OperandValueProviderInterface;

use Expression\Operands\Traits\OperandProviderTrait;
use Expression\Operands\Traits\OperandsCollectionTrait;
use Expression\Conditions\Functions\Traits\ValueProviderTrait;

use Expression\Operands\Value;

class Contains implements ExpressionableInterface, OperandValueProviderInterface
{
    use OperandProviderTrait,
        ValueProviderTrait,
        OperandsCollectionTrait;

    /**
     * @param OperandInterface $operandInterface
     * @param Value            $value
     */
    public function __construct(OperandInterface $operandInterface, Value $value)
    {
        $this->operand = $operandInterface;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function evaluate(): string
    {
        return "contains({$this->operand->evaluate()}, {$this->value->evaluate()})";
    }
}
