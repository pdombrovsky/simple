<?php

namespace Expression\Operands\Contracts;

interface ValueInterface
{
    /**
     * @return string|float|int|bool|array|null
     */
    function getValue(): string|float|int|bool|array|null;
}
