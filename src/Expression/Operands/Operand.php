<?php

namespace Expression\Operands;

use Expression\Attributes\AttributeNames;
use Expression\Operands\Contracts\OperandInterface;

use InvalidArgumentException;

class Operand implements OperandInterface
{
    /**
     * @var Operand|null
     */
    private ?Operand $next = null;

    /**
     * @var AttributeNames|null
     */
    private ?AttributeNames $attributeNames = null;

    /**
     * @param string $name
     * @param array  $indexes
     */
    public function __construct(private string $name, private array $indexes = [])
    {
    }

    /**
     * @param int $index
     * @return void
     */
    public function addIndex(int $index): void
    {
        if ($index < 0) {
            throw new InvalidArgumentException('Index must be non negative value');
        }

        $this->indexes[] = $index;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param Operand $next
     * @return static
     */
    public function setNext(Operand $next): static
    {
        return $this->next = $next;
    }

    /**
     * @return static|null
     */
    public function getNext(): ?static
    {
        return $this->next;
    }

    /**
     * @param AttributeNames|null $attributeNames
     * @return static
     */
    public function setAttributeNames(?AttributeNames $attributeNames): static
    {
        $this->attributeNames = $attributeNames;

        return $this;
    }

    /**
     * @return string
     */
    public function evaluate(): string
    {
        $expression = $this->attributeNames?->hasName($this->getName()) ? $this->attributeNames->getPlaceholder($this->getName()) : $this->getName();

        $expression .= $this->evaluateIndexes();

        if ($next = $this->getNext()) {

            if (! $this->getIndexesCount()) {
                $expression .= '.';
            }

            $expression .= $next->evaluate();
        }

        return $expression;
    }

    /**
     * @return int
     */
    private function getIndexesCount(): int
    {
        return count($this->indexes);
    }

    /**
     * @return string
     */
    private function evaluateIndexes(): string
    {
        return array_reduce($this->indexes, fn(string $result, int $item) => $result .= "[$item]", '');
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $path = $this->getName() . $this->evaluateIndexes();

        if ($this->getNext()) {

            if (! $this->getIndexesCount()) {
                $path .= '.';
            }

            $path .= $this->getNext()->__toString();
        }

        return $path;
    }

    /**
     * @return static
     */
    public function getOperand(): static
    {
        return $this;
    }
}
