<?php

namespace Expression\Conditions\Functions\Traits;

use Expression\Operands\Value;

trait ValueProviderTrait
{
    /**
     * @var Value
     */
    private Value $value;

    /**
     * @return Value[]
     */
    function getValues(): array
    {
        return [$this->value];
    }
}
