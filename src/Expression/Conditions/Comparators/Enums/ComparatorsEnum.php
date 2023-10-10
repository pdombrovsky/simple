<?php

namespace Expression\Conditions\Comparators\Enums;

enum ComparatorsEnum: string
{
    case Equal = ' = ';
    case NotEqual = ' <> ';
    case GreaterThan = ' > ';
    case GreaterThanOrEqual = ' >= ';
    case LessThan = ' < ';
    case LessThanOrEqual = ' <= ';
}
