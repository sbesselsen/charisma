<?php

namespace Charisma\Parser\Node\Statement;

use Charisma\Parser\Node\Expression\Expression;

final class ThrowStatement extends Statement
{
    /**
     * The expression to throw.
     *
     * @var Expression
     *   The expression.
     */
    public $expression;

    /**
     * ThrowStatement constructor.
     * @param Expression $expression
     */
    public function __construct(Expression $expression)
    {
        $this->expression = $expression;
    }
}
