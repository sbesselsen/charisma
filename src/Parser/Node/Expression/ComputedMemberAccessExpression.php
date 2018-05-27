<?php

namespace Charisma\Parser\Node\Expression;

final class ComputedMemberAccessExpression extends LValueExpression
{
    /**
     * The expression.
     *
     * @var Expression
     *   The expression.
     */
    public $expression;

    /**
     * The member.
     *
     * @var Expression
     *   The member.
     */
    public $member;

    /**
     * MemberAccessExpression constructor.
     * @param Expression $expression
     * @param Expression $member
     */
    public function __construct(Expression $expression, Expression $member)
    {
        $this->expression = $expression;
        $this->member = $member;
    }
}
