<?php

namespace Charisma\Parser\Node\Expression;

final class VariableAccessExpression extends LValueExpression
{
    /**
     * The variable name.
     *
     * @var string
     *   The name.
     */
    public $name;

    /**
     * VariableAccessExpression constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
