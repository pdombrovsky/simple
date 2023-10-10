<?php

namespace Expression\Contracts;

interface EvaluableInterface
{
    /**
     * @return string
     */
    function evaluate(): string;
}
