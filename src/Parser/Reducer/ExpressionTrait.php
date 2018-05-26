<?php

namespace Charisma\Parser\Reducer;

use Charisma\Parser\Node\Expression\AwaitExpression;
use Charisma\Parser\Node\Expression\BitwiseNotExpression;
use Charisma\Parser\Node\Expression\ComputedMemberAccessExpression;
use Charisma\Parser\Node\Expression\DeleteExpression;
use Charisma\Parser\Node\Expression\FunctionCallExpression;
use Charisma\Parser\Node\Expression\MemberAccessExpression;
use Charisma\Parser\Node\Expression\NewExpression;
use Charisma\Parser\Node\Expression\NotExpression;
use Charisma\Parser\Node\Expression\NumberExpression;
use Charisma\Parser\Node\Expression\PostfixDecrementExpression;
use Charisma\Parser\Node\Expression\PostfixIncrementExpression;
use Charisma\Parser\Node\Expression\PrefixDecrementExpression;
use Charisma\Parser\Node\Expression\PrefixIncrementExpression;
use Charisma\Parser\Node\Expression\StringExpression;
use Charisma\Parser\Node\Expression\TypeofExpression;
use Charisma\Parser\Node\Expression\UnaryNegationExpression;
use Charisma\Parser\Node\Expression\UnaryPlusExpression;
use Charisma\Parser\Node\Expression\VariableAccessExpression;
use Charisma\Parser\Node\Expression\VoidExpression;

trait ExpressionTrait
{
    protected function reduceNewExpression($constructor, $argumentList = null)
    {
        return new NewExpression($constructor, $argumentList ?? []);
    }

    protected function reduceConstructedNewExpression($functionCall)
    {
        /** @var FunctionCallExpression $functionCall */
        return new NewExpression($functionCall->expression, $functionCall->arguments);
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

    protected function reduceNotExpression($expression)
    {
        return new NotExpression($expression);
    }

    protected function reduceBitwiseNotExpression($expression)
    {
        return new BitwiseNotExpression($expression);
    }

    protected function reduceUnaryPlusExpression($expression)
    {
        return new UnaryPlusExpression($expression);
    }

    protected function reduceUnaryNegationExpression($expression)
    {
        return new UnaryNegationExpression($expression);
    }

    protected function reducePrefixIncrementExpression($expression)
    {
        return new PrefixIncrementExpression($expression);
    }

    protected function reducePrefixDecrementExpression($expression)
    {
        return new PrefixDecrementExpression($expression);
    }

    protected function reduceTypeofExpression($expression)
    {
        return new TypeofExpression($expression);
    }

    protected function reduceVoidExpression($expression)
    {
        return new VoidExpression($expression);
    }

    protected function reduceDeleteExpression($expression)
    {
        return new DeleteExpression($expression);
    }

    protected function reduceAwaitExpression($expression)
    {
        return new AwaitExpression($expression);
    }

    protected function reduceDoubleQuotedStringExpression($str) {
        // TODO: unescape
        return new StringExpression($str[0]);
    }

    protected function reduceSingleQuotedStringExpression($str) {
        // TODO: unescape
        return new StringExpression($str[0]);
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
