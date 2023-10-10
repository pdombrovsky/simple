<?php

declare(strict_types=1);

namespace Expression;

use Expression\Contracts\ExpressionableInterface;
use Expression\Operands\Contracts\OperandValueProviderInterface;

/**
 * Expression
 */
class Expression implements ExpressionableInterface
{
    /**
     * @param ExpressionableInterface $expression
     * @return void
     */
    public function __construct(private ExpressionableInterface $expression)
    {
    }

    /**
     * @return ExpressionableInterface
     */
    public function getCurrent(): ExpressionableInterface
    {
        return $this->expression;
    }

    /**
     * @param  ExpressionableInterface $expression
     * @return void
     */
    public function setCurrent(ExpressionableInterface $expression): void
    {
        $this->expression = $expression;
    }

    /**
     * @return string
     */
    public function evaluate(): string
    {
        return "( {$this->expression->evaluate()} )";
    }

    /**
     * @return OperandValueProviderInterface[]
     */
    public function getOperands(): array
    {
        return $this->expression->getOperands();
    }
}
