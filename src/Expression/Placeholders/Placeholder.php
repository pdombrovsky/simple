<?php

namespace Expression\Placeholders;

class Placeholder
{
    private const PREFIX_DEFAULT = ':';

    private const PLACEHOLDER_DEFAULT = 'val';

    /**
     * @var int
     */
    private int $counter = 0;

    /**
     * @param string $prefix
     * @param string $placeholder
     */
    public function __construct(private string $prefix = self::PREFIX_DEFAULT, private string $placeholder = self::PLACEHOLDER_DEFAULT)
    {
    }

    /**
     * @return string
     */
    public function create(): string
    {
        return $this->prefix . $this->placeholder . $this->counter++;
    }
}
