<?php

declare(strict_types=1);

namespace Expression;

use Expression\Conditions\Functions\Enums\AttributeTypesEnum;

use Expression\Operands\Contracts\OperandProviderInterface;

use Expression\Conditions\Functions\AttributeExists;
use Expression\Conditions\Functions\AttributeNotExists;
use Expression\Conditions\Functions\AttributeType;
use Expression\Conditions\Functions\BeginsWith;
use Expression\Conditions\Functions\Contains;
use Expression\Operands\Value;

class Functions
{
    /**
     * @param OperandProviderInterface $operandInterface
     * @return AttributeExists
     */
    public static function attributeExists(OperandProviderInterface $operandInterface): AttributeExists
    {
        return new AttributeExists($operandInterface->getOperand());
    }

    /**
     * @param OperandProviderInterface $operandInterface
     * @return AttributeNotExists
     */
    public static function attributeNotExists(OperandProviderInterface $operandInterface): AttributeNotExists
    {
        return new AttributeNotExists($operandInterface->getOperand());
    }

    /**
     * @param OperandProviderInterface $operandInterface
     * @param AttributeTypesEnum       $type
     * @return AttributeType
     */
    public static function attributeType(OperandProviderInterface $operandInterface, AttributeTypesEnum $type): AttributeType
    {
        return new AttributeType($operandInterface->getOperand(), new Value($type->value));
    }

    /**
     * @param OperandProviderInterface $operandInterface
     * @param string                   $substr
     * @return BeginsWith
     */
    public static function beginsWith(OperandProviderInterface $operandInterface, string $substr): BeginsWith
    {
        return new BeginsWith($operandInterface->getOperand(), new Value($substr));
    }

    /**
     * @param OperandProviderInterface $operandInterface
     * @param string|int|float         $value
     * @return Contains
     */
    public static function contains(OperandProviderInterface $operandInterface, float|int|string|array $value): Contains
    {
        return new Contains($operandInterface->getOperand(), new Value($value));
    }
}
