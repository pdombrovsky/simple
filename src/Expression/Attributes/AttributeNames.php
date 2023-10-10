<?php

namespace Expression\Attributes;

use RuntimeException;
use OutOfBoundsException;

class AttributeNames
{
    /**
     * @var string[]
     */
    private array $attributeNames = [];

    /**
     * @param string $name
     * @return bool
     */
    public function hasName(string $name): bool
    {
        return isset($this->attributeNames[$name]);
    }

    /**
     * @param string $placeholder
     * @return bool
     */
    public function hasPlaceholder(string $placeholder): bool
    {
        return in_array($placeholder, $this->attributeNames);
    }

    /**
     * @param string $name
     * @return string
     * @throws OutOfBoundsException
     */
    public function getPlaceholder(string $name): string
    {
        return $this->attributeNames[$name] ?? throw new OutOfBoundsException("There are no placeholder for operand $name");
    }

    /**
     * @param string $name
     * @param string $placeholder
     * @return void
     * @throws RuntimeException
     */
    public function attachNamePlaceholderPair(string $name, string $placeholder): void
    {
        if ($this->hasPlaceholder($placeholder))
            throw new RuntimeException("Placeholder '$placeholder' for name '$name' already attached");

        if ($this->hasName($name))
            throw new RuntimeException("Name '$name' already attached");

        $this->attributeNames[$name] = $placeholder;
    }

    /**
     * @return array
     */
    public function getExpression(): array
    {
        return array_flip($this->attributeNames);
    }
}
