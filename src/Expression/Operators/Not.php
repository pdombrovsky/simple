<?php

namespace Expression\Operators;

use Expression\Contracts\ExpressionableInterface;
use Expression\Operands\Contracts\OperandValueProviderInterface;


class Not implements ExpressionableInterface
{
    /**
     * @param ExpressionableInterface $condition
     */
    public function __construct(private ExpressionableInterface $condition)
    {
    }

    /**
     * @return string
     */
    public function evaluate(): string
    {
        return 'not ' . $this->condition->evaluate();
    }

    /**
     * @return OperandValueProviderInterface[]
     */
    public function getOperands(): array
    {
        return $this->condition->getOperands();
    }
}
