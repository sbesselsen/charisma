<?php

namespace Charisma\Parser\Node\Expression;

final class NumberExpression extends Expression
{
    /**
     * The value.
     *
     * @var int|double
     *   The value.
     */
    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
