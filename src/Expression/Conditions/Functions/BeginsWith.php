<?php

namespace Expression\Conditions\Functions;

use Expression\Contracts\ExpressionableInterface;
use Expression\Operands\Contracts\OperandInterface;
use Expression\Operands\Contracts\OperandValueProviderInterface;

use Expression\Operands\Traits\OperandProviderTrait;
use Expression\Conditions\Functions\Traits\ValueProviderTrait;
use Expression\Operands\Traits\OperandsCollectionTrait;

use Expression\Operands\Value;

class BeginsWith implements ExpressionableInterface, OperandValueProviderInterface
{
    use OperandProviderTrait,
        ValueProviderTrait,
        OperandsCollectionTrait;

    /**
     * @var Value
     */
    private Value $value;

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
        return "begins_with({$this->operand->evaluate()}, {$this->value->evaluate()})";
    }
}
