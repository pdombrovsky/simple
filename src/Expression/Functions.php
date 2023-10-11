<?php

declare(strict_types=1);

namespace Expression;

use Expression\Conditions\Functions\Enums\AttributeTypesEnum;

use Expression\Attribute;
use Expression\Conditions\Functions\AttributeExists;
use Expression\Conditions\Functions\AttributeNotExists;
use Expression\Conditions\Functions\AttributeType;
use Expression\Conditions\Functions\BeginsWith;
use Expression\Conditions\Functions\Contains;
use Expression\Operands\Value;

class Functions
{
    /**
     * @param Attribute $attribute
     * @return AttributeExists
     */
    public static function attributeExists(Attribute $attribute): AttributeExists
    {
        return new AttributeExists($attribute->getOperand());
    }

    /**
     * @param Attribute $attribute
     * @return AttributeNotExists
     */
    public static function attributeNotExists(Attribute $attribute): AttributeNotExists
    {
        return new AttributeNotExists($attribute->getOperand());
    }

    /**
     * @param Attribute          $attribute
     * @param AttributeTypesEnum $type
     * @return AttributeType
     */
    public static function attributeType(Attribute $attribute, AttributeTypesEnum $type): AttributeType
    {
        return new AttributeType($attribute->getOperand(), new Value($type->value));
    }

    /**
     * @param Attribute $attribute
     * @param string    $substr
     * @return BeginsWith
     */
    public static function beginsWith(Attribute $attribute, string $substr): BeginsWith
    {
        return new BeginsWith($attribute->getOperand(), new Value($substr));
    }

    /**
     * @param Attribute        $attribute
     * @param string|int|float $value
     * @return Contains
     */
    public static function contains(Attribute $attribute, float|int|string|array $value): Contains
    {
        return new Contains($attribute->getOperand(), new Value($value));
    }
}
