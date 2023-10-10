<?php

namespace Expression\Conditions;

use Expression\Contracts\ExpressionableInterface;
use Expression\Operands\Contracts\OperandInterface;
use Expression\Operands\Contracts\OperandValueProviderInterface;

use Expression\Conditions\Traits\OperandProviderTrait;
use Expression\Operands\Traits\OperandsCollectionTrait;

use Expression\Operands\Value;

class Between implements ExpressionableInterface, OperandValueProviderInterface
{
    use OperandProviderTrait,
        OperandsCollectionTrait;

    /**
     * @param OperandInterface $operandInterface
     * @param Value            $value1
     * @param Value            $value2
     */
    public function __construct(OperandInterface $operandInterface, private Value $value1, private Value $value2)
    {
        $this->operandInterface = $operandInterface;
    }

    /**
     * @return string
     */
    public function evaluate(): string
    {
        return $this->operandInterface->evaluate() . ' between ' . $this->value1->evaluate() . ' and ' . $this->value2->evaluate();
    }

    /**
     * @return Value[]
     */
    public function getValues(): array
    {
        return [$this->value1, $this->value2];
    }
}
