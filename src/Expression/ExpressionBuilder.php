<?php

declare(strict_types=1);

namespace Expression;

use Expression\Operators\Enums\BinaryOperatorsEnum;

use Expression\Contracts\ExpressionableInterface;

use Expression\Operators\Not;
use Expression\Operators\BinaryOperator;
use Expression\Expression;

use RuntimeException;

/**
 * ExpressionBuilder
 */
class ExpressionBuilder
{
    /**
     * @var Expression|null
     */
    private ?Expression $expression;

    /**
     * @param  null|ExpressionableInterface|callable(callable(?ExpressionableInterface):ExpressionBuilder $innerBuilderCallable): Expression $condition
     * @return void
     */
    public function __construct(null|ExpressionableInterface|callable $condition = null)
    {
        if (is_callable($condition))
            $condition = $condition(fn(?ExpressionableInterface $expression = null) => new static($expression));

        $this->expression = $condition ? new Expression($condition) : null;
    }

    /**
     * @return ExpressionableInterface
     */
    public function getExpression(): ExpressionableInterface
    {
        return $this->expression ?? throw new RuntimeException('Expression not exists');
    }

    /**
     * @param  ExpressionableInterface|ExpressionableInterface[]|callable(callable(?ExpressionableInterface):ExpressionBuilder $innerBuilderCallable): Expression $condition
     * @return static
     */
    public function and (ExpressionableInterface|array|callable $condition): static
    {
        return $this->addExpression(BinaryOperatorsEnum::And , $condition);
    }

    /**
     * @param  ExpressionableInterface|ExpressionableInterface[]|callable(callable(?ExpressionableInterface):ExpressionBuilder $innerBuilderCallable): Expression $condition
     * @return static
     */
    public function andNot(ExpressionableInterface|array|callable $condition): static
    {
        return $this->addExpression(BinaryOperatorsEnum::And , $condition, true);
    }

    /**
     * @param  ExpressionableInterface|ExpressionableInterface[]|callable(callable(?ExpressionableInterface):ExpressionBuilder $innerBuilderCallable): Expression $condition
     * @return static
     */
    public function or (ExpressionableInterface|array|callable $condition): static
    {
        return $this->addExpression(BinaryOperatorsEnum::Or , $condition);
    }

    /**
     * @param  ExpressionableInterface|ExpressionableInterface[]|callable(callable(?ExpressionableInterface):ExpressionBuilder $innerBuilderCallable): Expression $condition
     * @return static
     */
    public function orNot(ExpressionableInterface|array|callable $condition): static
    {
        return $this->addExpression(BinaryOperatorsEnum::Or , $condition, true);
    }

    /**
     * @param BinaryOperatorsEnum $operator
     * @param ExpressionableInterface|ExpressionableInterface[]|callable(callable(?ExpressionableInterface):ExpressionBuilder $innerBuilderCallable): Expression $condition
     * @param bool $invert
     * @return static
     */
    private function addExpression(BinaryOperatorsEnum $operator, ExpressionableInterface|array|callable $condition, bool $invert = false): static
    {
        if (! $this->expression) {
            if (is_callable($condition) || $condition instanceof ExpressionableInterface) {
                throw new RuntimeException("Can't add condition for empty expression");
            }

            if (2 > count($condition)) {
                throw new RuntimeException('There must be at least two conditions in array when expression is empty');
            } else {
                $firstKey = array_key_first($condition);
                $this->expression = new Expression($invert ? new Not($condition[$firstKey]) : $condition[$firstKey]);
                unset($condition[$firstKey]);
            }
        }

        if (is_array($condition)) {
            foreach ($condition as $item) {
                $this->expression->setCurrent(new BinaryOperator($operator, $this->expression->getCurrent(), $invert ? new Not($item) : $item));
            }
        } else {
            if (is_callable($condition))
                $condition = $condition(fn(?ExpressionableInterface $expression = null) => new static($expression));

            $this->expression->setCurrent(new BinaryOperator($operator, $this->expression->getCurrent(), $invert ? new Not($condition) : $condition));
        }

        return $this;
    }
}
