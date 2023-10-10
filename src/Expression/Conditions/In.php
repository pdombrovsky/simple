<?php

namespace Expression\Conditions;

use Expression\Contracts\ExpressionableInterface;
use Expression\Operands\Contracts\OperandInterface;
use Expression\Operands\Contracts\OperandValueProviderInterface;

use Expression\Operands\Traits\OperandsCollectionTrait;
use Expression\Conditions\Traits\OperandProviderTrait;

use Expression\Operands\Value;
use Expression\ExpressionBuilder;

class In implements ExpressionableInterface, OperandValueProviderInterface
{
    private const LIMIT = 100;

    use OperandProviderTrait,
        OperandsCollectionTrait;

    /**
     * @param OperandInterface $operandInterface
     * @param Value[] $values
     */
    public function __construct(OperandInterface $operandInterface, private array $values)
    {
        $this->operandInterface = $operandInterface;
    }

    /**
     * @return string
     */
    public function evaluate(): string
    {
        if (count($this->values) <= static::LIMIT)
            return sprintf('%s in (%s)', $this->operandInterface->evaluate(), $this->evaluateValues());

        $chunks = array_map(fn(array $chunk) => new static($this->operandInterface, $chunk), array_chunk($this->values, static::LIMIT));

        $subExpression = (new ExpressionBuilder())->or($chunks)->getExpression();

        return $subExpression->evaluate();
    }

    /**
     * @return string
     */
    private function evaluateValues(): string
    {
        return implode(', ', array_map(fn(Value $value) => $value->evaluate(), $this->values));
    }

    /**
     * @return Value[]
     */
    public function getValues(): array
    {
        return $this->values;
    }
}
