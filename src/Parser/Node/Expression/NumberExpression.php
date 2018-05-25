<?php

namespace Charisma\Parser\Node\Expression;

final class NumberExpression extends ValueExpression
{
    /**
     * The value.
     *
     * @var int|double
     *   The value.
     */
    public $value;

    /**
     * NumberExpression constructor.
     * @param int|double $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }
}
