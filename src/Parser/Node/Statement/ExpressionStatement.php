<?php

namespace Charisma\Parser\Node\Statement;

use Charisma\Parser\Node\Expression\Expression;

final class ExpressionStatement extends Statement
{
    /**
     * The expression.
     *
     * @var Expression
     *   The expression.
     */
    public $expression;

    /**
     * ExpressionStatement constructor.
     * @param Expression $expression
     */
    public function __construct(Expression $expression)
    {
        $this->expression = $expression;
    }
}
