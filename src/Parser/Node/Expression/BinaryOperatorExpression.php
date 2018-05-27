<?php

namespace Charisma\Parser\Node\Expression;

abstract class BinaryOperatorExpression extends Expression
{
    /**
     * The left expression.
     *
     * @var Expression
     *   The expression.
     */
    public $left;

    /**
     * The right expression.
     *
     * @var Expression
     *   The expression.
     */
    public $right;

    /**
     * BinaryOperatorExpression constructor.
     * @param Expression $left
     * @param Expression $right
     */
    public function __construct(Expression $left, Expression $right)
    {
        $this->left = $left;
        $this->right = $right;
    }
}
