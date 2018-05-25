<?php

namespace Charisma\Parser\Reducer;

use Charisma\Parser\Node\Expression\ComputedMemberAccessExpression;
use Charisma\Parser\Node\Expression\MemberAccessExpression;
use Charisma\Parser\Node\Expression\NumberExpression;
use Charisma\Parser\Node\Expression\VariableAccessExpression;

trait ExpressionTrait
{
    protected function reduceMemberAccessExpression($expression, $member)
    {
        return new MemberAccessExpression($expression, $member[0]);
    }

    protected function reduceComputedMemberAccessExpression($expression, $memberExpression)
    {
        return new ComputedMemberAccessExpression($expression, $memberExpression);
    }

    protected function reduceVariableAccessExpression($name)
    {
        return new VariableAccessExpression($name[0]);
    }

    protected function reduceIntegerNumberExpression($number)
    {
        return new NumberExpression((int)$number[0]);
    }

    protected function reduceFloatNumberExpression($number)
    {
        return new NumberExpression((double)$number[0]);
    }

    protected function reduceOctalNumberExpression($number)
    {
        return new NumberExpression((int)octdec($number[0]));
    }
}