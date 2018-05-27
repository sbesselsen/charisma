<?php

namespace Charisma\Parser\Node\Expression;

final class MemberAccessExpression extends LValueExpression
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
     * @var string
     *   The member.
     */
    public $member;

    /**
     * MemberAccessExpression constructor.
     * @param Expression $expression
     * @param string $member
     */
    public function __construct(Expression $expression, string $member)
    {
        $this->expression = $expression;
        $this->member = $member;
    }
}
