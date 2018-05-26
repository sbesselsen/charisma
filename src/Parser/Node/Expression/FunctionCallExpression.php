<?php

namespace Charisma\Parser\Node\Expression;

final class FunctionCallExpression extends Expression
{
    /**
     * The function expression.
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
     * FunctionCallExpression constructor.
     * @param Expression $expression
     * @param Expression[] $arguments
     */
    public function __construct(Expression $expression, array $arguments)
    {
        $this->expression = $expression;
        $this->arguments = $arguments;
    }
}
