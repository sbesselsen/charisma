<?php

namespace Charisma\Parser\Reducer;

use Charisma\Parser\Node\Expression\ComputedMemberAccessExpression;
use Charisma\Parser\Node\Expression\FunctionCallExpression;
use Charisma\Parser\Node\Expression\MemberAccessExpression;
use Charisma\Parser\Node\Expression\NewExpression;
use Charisma\Parser\Node\Expression\NumberExpression;
use Charisma\Parser\Node\Expression\PostfixDecrementExpression;
use Charisma\Parser\Node\Expression\PostfixIncrementExpression;
use Charisma\Parser\Node\Expression\VariableAccessExpression;

trait ExpressionTrait
{
    protected function reduceNewExpression($constructor, $argumentList = null)
    {
        return new NewExpression($constructor, $argumentList ?? []);
    }

    protected function reduceFunctionCallExpression($function, $argumentList = null)
    {
        return new FunctionCallExpression($function, $argumentList ?? []);
    }

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

    protected function reducePostfixIncrementExpression($expression)
    {
        return new PostfixIncrementExpression($expression);
    }

    protected function reducePostfixDecrementExpression($expression)
    {
        return new PostfixDecrementExpression($expression);
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
