<?php

namespace Charisma\Parser\Node\Expression;

abstract class UnaryOperatorExpression extends Expression
{
    /**
     * The expression.
     *
     * @var Expression
     *   The expression.
     */
    public $expression;

    /**
     * UnaryOperatorExpression constructor.
     * @param Expression $expression
     */
    public function __construct(Expression $expression)
    {
        $this->expression = $expression;
    }
}
