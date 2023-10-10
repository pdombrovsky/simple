<?php

namespace Expression\Conditions\Functions\Enums;

enum AttributeTypesEnum: string
{
    case String = 'S';
    case StringSet = 'SS';
    case Number = 'N';
    case NumberSet = 'NS';
    case Binary = 'B';
    case BinarySet = 'BS';
    case Boolean = 'BOOL';
    case Null = 'NULL';
    case List = 'L';
    case Map = 'M';
}
