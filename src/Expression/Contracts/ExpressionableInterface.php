<?php

namespace Expression\Contracts;

use Expression\Contracts\EvaluableInterface;
use Expression\Operands\Contracts\OperandsCollectionInterface;

interface ExpressionableInterface extends EvaluableInterface, OperandsCollectionInterface
{
}
