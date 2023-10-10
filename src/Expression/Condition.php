<?php

declare(strict_types=1);

namespace Expression;

use Expression\Conditions\Comparators\Enums\ComparatorsEnum;

use Expression\Contracts\ExpressionableInterface;
use Expression\Operands\Contracts\OperandInterface;
use Expression\Operands\Contracts\OperandProviderInterface;

use Expression\Conditions\Between;
use Expression\Conditions\In;
use Expression\Conditions\Comparators\Comparator;
use Expression\Conditions\Functions\Size;
use Expression\Operands\Value;

class Condition
{
    /**
     * @param OperandInterface $operandInterface
     */
    private function __construct(private OperandInterface $operandInterface)
    {
    }

    /**
     * @param OperandProviderInterface $operandProviderInterface
     * @return static
     */
    public static function operand(OperandProviderInterface $operandProviderInterface): static
    {
        return new static($operandProviderInterface->getOperand());
    }

    /**
     * @param OperandProviderInterface $operandProviderInterface
     * @return static
     */
    public static function size(OperandProviderInterface $operandProviderInterface): static
    {
        return new static(new Size($operandProviderInterface->getOperand()));
    }

    /**
     * @param float|int|bool $value
     * @return Comparator
     */
    public function gt(float|int|bool $value): Comparator
    {
        return new Comparator($this->operandInterface, ComparatorsEnum::GreaterThan, new Value($value));
    }

    /**
     * @param float|int|bool $value
     * @return Comparator
     */
    public function gte(float|int|bool $value): Comparator
    {
        return new Comparator($this->operandInterface, ComparatorsEnum::GreaterThanOrEqual, new Value($value));
    }

    /**
     * @param float|int|bool $value
     * @return Comparator
     */
    public function lt(float|int|bool $value): Comparator
    {
        return new Comparator($this->operandInterface, ComparatorsEnum::LessThan, new Value($value));
    }

    /**
     * @param float|int|bool $value
     * @return Comparator
     */
    public function lte(float|int|bool $value): Comparator
    {
        return new Comparator($this->operandInterface, ComparatorsEnum::LessThanOrEqual, new Value($value));
    }

    /**
     * @param float|int|bool|string|null $value
     * @return Comparator
     */
    public function eq(float|int|bool|string|null $value): Comparator
    {
        return new Comparator($this->operandInterface, ComparatorsEnum::Equal, new Value($value));
    }

    /**
     * @param float|int|bool|string|null $value
     * @return Comparator
     */
    public function ne(float|int|bool|string|null $value): Comparator
    {
        return new Comparator($this->operandInterface, ComparatorsEnum::NotEqual, new Value($value));
    }

    /**
     * @param array $values
     * @return In|ExpressionableInterface
     */
    public function in(array $values): In|ExpressionableInterface
    {
        return new In($this->operandInterface, array_map(fn(float|int|bool|string $item) => new Value($item), $values));
    }

    /**
     * @param float|int $value1
     * @param float|int $value2
     * @return Between
     */
    public function between(float|int $value1, float|int $value2): Between
    {
        if ($value1 > $value2)
            [$value2, $value1] = [$value1, $value2];

        return new Between($this->operandInterface, new Value($value1), new Value($value2));
    }
}
