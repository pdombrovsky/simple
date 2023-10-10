<?php

namespace Expression\Conditions\Comparators;

use Expression\Conditions\Comparators\Enums\ComparatorsEnum;

use Expression\Contracts\ExpressionableInterface;
use Expression\Operands\Contracts\OperandInterface;
use Expression\Operands\Contracts\OperandValueProviderInterface;

use Expression\Conditions\Traits\OperandProviderTrait;
use Expression\Operands\Traits\OperandsCollectionTrait;

use Expression\Operands\Value;

class Comparator implements ExpressionableInterface, OperandValueProviderInterface
{
    use OperandProviderTrait,
        OperandsCollectionTrait;

    /**
     * @param OperandInterface $operandInterface
     * @param ComparatorsEnum  $comparator
     * @param Value            $operandValue
     */
    public function __construct(OperandInterface $operandInterface, private ComparatorsEnum $comparator, private Value $operandValue)
    {
        $this->operandInterface = $operandInterface;
    }

    /**
     * @return string
     */
    public function evaluate(): string
    {
        return $this->operandInterface->evaluate() . $this->comparator->value . $this->operandValue->evaluate();
    }

    /**
     * @return Value[]
     */
    public function getValues(): array
    {
        return [$this->operandValue];
    }
}
