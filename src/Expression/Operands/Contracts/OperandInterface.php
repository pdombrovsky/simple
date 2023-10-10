<?php

namespace Expression\Operands\Contracts;

use Expression\Contracts\EvaluableInterface;

use Expression\Operands\Contracts\OperandProviderInterface;

interface OperandInterface extends EvaluableInterface, OperandProviderInterface
{
}
