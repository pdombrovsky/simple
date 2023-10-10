<?php

declare(strict_types=1);

namespace Expression;

use Expression\Operands\Contracts\OperandProviderInterface;

use Expression\Operands\Traits\OperandProviderTrait;

use Expression\Operands\Operand;

class Attribute implements OperandProviderInterface
{
    use OperandProviderTrait;

    /**
     * @var Operand
     */
    private Operand $current;

    /**
     * @param Operand $root
     */
    private function __construct(Operand $root)
    {
        $this->operand = $this->current = $root;
    }

    /**
     * @param string $attribute
     * @return static
     */
    public static function create(string $attribute): static
    {
        return new static(new Operand($attribute));
    }

    /**
     * @param string $path
     * @return static
     */
    public function with(string $path): static
    {
        $this->current = $this->current->setNext(new Operand($path));

        return $this;
    }

    /**
     * @param int $index
     * @return static
     */
    public function index(int $index): static
    {
        $this->current->addIndex($index);

        return $this;
    }
}
