<?php

namespace Charisma\Parser\Node\Expression;

final class ConditionalExpression extends Expression
{
    /**
     * The condition.
     *
     * @var Expression
     *   The condition.
     */
    public $condition;

    /**
     * The if.
     *
     * @var Expression
     *   The if.
     */
    public $if;

    /**
     * The else.
     *
     * @var Expression
     *   The else.
     */
    public $else;

    /**
     * ConditionalExpression constructor.
     * @param Expression $condition
     * @param Expression $if
     * @param Expression $else
     */
    public function __construct(Expression $condition, Expression $if, Expression $else)
    {
        $this->condition = $condition;
        $this->if = $if;
        $this->else = $else;
    }
}
