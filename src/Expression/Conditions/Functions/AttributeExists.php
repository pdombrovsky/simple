<?php

namespace Expression\Conditions\Functions;

use Expression\Contracts\ExpressionableInterface;
use Expression\Operands\Contracts\OperandInterface;
use Expression\Operands\Contracts\OperandValueProviderInterface;

use Expression\Operands\Traits\OperandProviderTrait;
use Expression\Operands\Traits\OperandsCollectionTrait;

use Expression\Operands\Value;

class AttributeExists implements ExpressionableInterface, OperandValueProviderInterface
{
    use OperandProviderTrait,
        OperandsCollectionTrait;

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
        return "attribute_exists({$this->operand->evaluate()})";
    }

    /**
     * @return array|Value[]
     */
    public function getValues(): array
    {
        return [];
    }
}
