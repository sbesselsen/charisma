<?php

namespace Charisma\Parser\Node\Expression;

final class StringExpression extends ValueExpression
{
    /**
     * The value.
     *
     * @var string
     *   The value.
     */
    public $value;

    /**
     * StringExpression constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
