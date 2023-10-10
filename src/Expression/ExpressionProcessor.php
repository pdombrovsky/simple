<?php

namespace Expression;

use Expression\Operands\Contracts\OperandInterface;
use Expression\Operands\Contracts\OperandValueProviderInterface;
use Expression\Predicates\Contracts\StringPredicateInterface;

use Expression\Attributes\AttributeNames;
use Expression\Attributes\AttributeValues;
use Expression\Operands\Operand;
use Expression\Operands\Value;
use Expression\Placeholders\Placeholder;
use Expression\Predicates\DefaultPredicate;

class ExpressionProcessor
{
    /**
     * @var StringPredicateInterface
     */
    private StringPredicateInterface $isPlaceholderRequired;

    public function __construct(private AttributeNames $attributeNames, private AttributeValues $attributeValues, private Placeholder $operandPlaceholder, private Placeholder $valuePlaceholder, bool|StringPredicateInterface $isOperandPlaceholderRequired = true)
    {
        $this->isPlaceholderRequired = is_bool($isOperandPlaceholderRequired) ? new DefaultPredicate($isOperandPlaceholderRequired) : $isOperandPlaceholderRequired;
    }

    /**
     * @return array
     */
    public function getExpressionAttributeNames(): array
    {
        return $this->attributeNames->getExpression();
    }

    /**
     * @return array
     */
    public function getExpressionAttributeValues(): array
    {
        return $this->attributeValues->getExpression();
    }

    /**
     * @param OperandValueProviderInterface[] $expressionOperands
     * @param ?callable(string $type, string|float|int|bool|array|null $value, OperandInterface $operand): mixed $valueTransfomer
     */
    public function process(array $expressionOperands, ?callable $valueTransfomer = null): void
    {
        foreach ($expressionOperands as $operandValueProvider) {

            $this->processOperand($operandValueProvider->getOperand());

            $type = $valueTransfomer ? get_class($operandValueProvider) : '';

            foreach ($operandValueProvider->getValues() as $value) {
                $this->processValue($value);

                if ($type) {
                    $value->transform(fn(string|float|int|bool|array|null $value) => $valueTransfomer($type, $value, $operandValueProvider->getOperand()));
                }
            }
        }
    }

    /**
     * @param Operand $operand
     * @return void
     */
    private function processOperand(OperandInterface $operand): void
    {
        $operand->setAttributeNames($this->attributeNames);

        if (($this->isPlaceholderRequired)($operand->getName()) && ! $this->attributeNames->hasName($operand->getName())) {
            $this->attributeNames->attachNamePlaceholderPair($operand->getName(), $this->operandPlaceholder->create());
        }

        if ($next = $operand->getNext()) {
            $this->processOperand($next);
        }
    }

    /**
     * @param Value $value
     * @return void
     */
    private function processValue(Value $value): void
    {
        $value->setAttributeValues($this->attributeValues);

        if (! $this->attributeValues->hasValue($value)) {
            $this->attributeValues->attachValuePlaceholderPair($value, $this->valuePlaceholder->create());
        }
    }
}
