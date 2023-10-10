<?php

namespace Expression\Attributes;

use Aws\DynamoDb\Marshaler;

use RuntimeException;
use OutOfBoundsException;
use SplObjectStorage;

use Expression\Operands\Contracts\ValueInterface;

class AttributeValues
{
    /**
     * @var SplObjectStorage
     */
    private SplObjectStorage $attributeValues;

    /**
     * @param Marshaler $marshaler
     */
    public function __construct(private Marshaler $marshaler)
    {
        $this->attributeValues = new SplObjectStorage();
    }

    /**
     * @param ValueInterface $item
     * @return bool
     */
    public function hasValue(ValueInterface $item): bool
    {
        return $this->attributeValues->contains($item);
    }

    /**
     * @param string $placeholder
     * @return bool
     */
    public function hasPlaceholder(string $placeholder): bool
    {
        foreach ($this->attributeValues as $item)
            if ($placeholder === $this->attributeValues[$item])
                return true;

        return false;
    }

    /**
     * @param ValueInterface $item
     * @return string
     * @throws OutOfBoundsException
     */
    public function getPlaceholder(ValueInterface $item): string
    {
        return $this->attributeValues[$item] ?? throw new OutOfBoundsException("There are no placeholder for value: '{$item->getValue()}'");
    }

    /**
     * @param ValueInterface $item
     * @param string         $placeholder
     * @return void
     * @throws RuntimeException
     */
    public function attachValuePlaceholderPair(ValueInterface $item, string $placeholder): void
    {
        if ($this->hasValue($item))
            throw new RuntimeException("Value '{$item->getValue()}' already attached");

        if ($this->hasPlaceholder($placeholder))
            throw new RuntimeException("Placeholder '$placeholder' for value: '{$item->getValue()}' already attached");

        $this->attributeValues[$item] = $placeholder;
    }

    /**
     * @return array
     */
    public function getExpression(): array
    {
        $expression = [];
        foreach ($this->attributeValues as $item)
            $expression[$this->attributeValues[$item]] = $this->marshaler->marshalValue($item->getValue());

        return $expression;
    }
}
