<?php

namespace Expression\Operands;

use Expression\Attributes\AttributeValues;
use Expression\Operands\Contracts\ValueInterface;

use RuntimeException;

class Value implements ValueInterface
{
    /**
     * @var AttributeValues|null
     */
    private ?AttributeValues $attributeValues = null;

    /**
     * @param string|float|int|bool|array $value
     */
    public function __construct(private string|float|int|bool|array|null $value)
    {
    }

    /**
     * @return string|float|int|bool|array|null
     */
    public function getValue(): string|float|int|bool|array|null
    {
        return $this->value;
    }

    /**
     * @param AttributeValues $attributeValues
     * @return void
     */
    public function setAttributeValues(AttributeValues $attributeValues): void
    {
        $this->attributeValues = $attributeValues;
    }

    /**
     * @param callable(string|float|int|bool|array|null $value): string|float|int|bool|array|null $transformer
     */
    public function transform(callable $transformer): void
    {
        $this->value = $transformer($this->value);
    }

    /**
     * @return string
     * @throws RuntimeException
     */
    public function evaluate(): string
    {
        return $this->attributeValues?->getPlaceholder($this) ??
            throw new RuntimeException("AttributeValues must be set before call evaluate method");
    }
}
