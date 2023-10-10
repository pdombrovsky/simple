<?php

namespace Expression\Operators;

use Expression\Operators\Enums\BinaryOperatorsEnum;

use Expression\Contracts\ExpressionableInterface;
use Expression\Operands\Contracts\OperandValueProviderInterface;

class BinaryOperator implements ExpressionableInterface
{
    /**
     * @param BinaryOperatorsEnum     $operator
     * @param ExpressionableInterface $left
     * @param ExpressionableInterface $right
     */
    public function __construct(private BinaryOperatorsEnum $operator, private ExpressionableInterface $left, private ExpressionableInterface $right)
    {
    }

    /**
     * @return string
     */
    public function evaluate(): string
    {
        return static::format($this->left->evaluate(), $this->operator->value, $this->right->evaluate());
    }

    /**
     * @param string $left
     * @param string $operator
     * @param string $right
     * @return string
     */
    protected static function format(string $left, string $operator, string $right): string
    {
        return sprintf('%s %s %s', $left, $operator, $right);
    }

    /**
     * @return OperandValueProviderInterface[]
     */
    public function getOperands(): array
    {
        return [...$this->left->getOperands(), ...$this->right->getOperands()];
    }
}
