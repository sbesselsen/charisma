<?php

namespace Charisma\Parser\Node\Expression;

final class NewExpression extends Expression
{
    /**
     * The constructor expression.
     *
     * @var Expression
     *   The expression.
     */
    public $expression;

    /**
     * The arguments.
     *
     * @var Expression[]
     *   The arguments.
     */
    public $arguments;

    /**
     * NewExpression constructor.
     * @param Expression $expression
     * @param Expression[] $arguments
     */
    public function __construct(Expression $expression, array $arguments)
    {
        $this->expression = $expression;
        $this->arguments = $arguments;
    }
}
