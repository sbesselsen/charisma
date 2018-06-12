<?php

namespace Charisma\Parser\Reducer;

use Charisma\Parser\Node\Expression\AddAssignmentExpression;
use Charisma\Parser\Node\Expression\AddExpression;
use Charisma\Parser\Node\Expression\ArrayExpression;
use Charisma\Parser\Node\Expression\AssignmentExpression;
use Charisma\Parser\Node\Expression\AwaitExpression;
use Charisma\Parser\Node\Expression\BitwiseAndAssignmentExpression;
use Charisma\Parser\Node\Expression\BitwiseAndExpression;
use Charisma\Parser\Node\Expression\BitwiseLeftShiftAssignmentExpression;
use Charisma\Parser\Node\Expression\BitwiseLeftShiftExpression;
use Charisma\Parser\Node\Expression\BitwiseNotExpression;
use Charisma\Parser\Node\Expression\BitwiseOrAssignmentExpression;
use Charisma\Parser\Node\Expression\BitwiseOrExpression;
use Charisma\Parser\Node\Expression\BitwiseRightShiftAssignmentExpression;
use Charisma\Parser\Node\Expression\BitwiseRightShiftExpression;
use Charisma\Parser\Node\Expression\BitwiseUnsignedRightShiftAssignmentExpression;
use Charisma\Parser\Node\Expression\BitwiseUnsignedRightShiftExpression;
use Charisma\Parser\Node\Expression\BitwiseXorAssignmentExpression;
use Charisma\Parser\Node\Expression\BitwiseXorExpression;
use Charisma\Parser\Node\Expression\ComputedMemberAccessExpression;
use Charisma\Parser\Node\Expression\ConditionalExpression;
use Charisma\Parser\Node\Expression\ConstantExpression;
use Charisma\Parser\Node\Expression\DeleteExpression;
use Charisma\Parser\Node\Expression\DivideAssignmentExpression;
use Charisma\Parser\Node\Expression\DivideExpression;
use Charisma\Parser\Node\Expression\EqualityExpression;
use Charisma\Parser\Node\Expression\ExponentAssignmentExpression;
use Charisma\Parser\Node\Expression\ExponentExpression;
use Charisma\Parser\Node\Expression\FunctionCallExpression;
use Charisma\Parser\Node\Expression\FunctionDefinitionExpression;
use Charisma\Parser\Node\Expression\GreaterThanExpression;
use Charisma\Parser\Node\Expression\GreaterThanOrEqualExpression;
use Charisma\Parser\Node\Expression\InequalityExpression;
use Charisma\Parser\Node\Expression\InExpression;
use Charisma\Parser\Node\Expression\InstanceofExpression;
use Charisma\Parser\Node\Expression\LessThanExpression;
use Charisma\Parser\Node\Expression\LessThanOrEqualExpression;
use Charisma\Parser\Node\Expression\LogicalAndExpression;
use Charisma\Parser\Node\Expression\LogicalOrExpression;
use Charisma\Parser\Node\Expression\LValueExpression;
use Charisma\Parser\Node\Expression\MemberAccessExpression;
use Charisma\Parser\Node\Expression\ModuloAssignmentExpression;
use Charisma\Parser\Node\Expression\ModuloExpression;
use Charisma\Parser\Node\Expression\MultiplyAssignmentExpression;
use Charisma\Parser\Node\Expression\MultiplyExpression;
use Charisma\Parser\Node\Expression\NewExpression;
use Charisma\Parser\Node\Expression\NotExpression;
use Charisma\Parser\Node\Expression\NumberExpression;
use Charisma\Parser\Node\Expression\ObjectExpression;
use Charisma\Parser\Node\Expression\ParenExpression;
use Charisma\Parser\Node\Expression\PostfixDecrementExpression;
use Charisma\Parser\Node\Expression\PostfixIncrementExpression;
use Charisma\Parser\Node\Expression\PrefixDecrementExpression;
use Charisma\Parser\Node\Expression\PrefixIncrementExpression;
use Charisma\Parser\Node\Expression\RegexExpression;
use Charisma\Parser\Node\Expression\StrictEqualityExpression;
use Charisma\Parser\Node\Expression\StrictInequalityExpression;
use Charisma\Parser\Node\Expression\StringExpression;
use Charisma\Parser\Node\Expression\SubtractAssignmentExpression;
use Charisma\Parser\Node\Expression\SubtractExpression;
use Charisma\Parser\Node\Expression\TypeofExpression;
use Charisma\Parser\Node\Expression\UnaryNegationExpression;
use Charisma\Parser\Node\Expression\UnaryPlusExpression;
use Charisma\Parser\Node\Expression\VariableAccessExpression;
use Charisma\Parser\Node\Expression\VoidExpression;
use Charisma\Parser\Node\Expression\YieldExpression;
use Charisma\Parser\Node\Expression\YieldStarExpression;
use Charisma\Parser\Node\FunctionDefinitionNode;
use Charisma\Parser\Node\FunctionParameterNode;
use Charisma\Parser\Node\ObjectItemNode;

trait ExpressionTrait
{
    protected function reduceParenExpression($expression)
    {
        return new ParenExpression($expression);
    }

    protected function reduceNewExpression($constructor, $argumentList = null)
    {
        if ($constructor instanceof FunctionCallExpression) {
            return new NewExpression($constructor->expression, $constructor->arguments);
        }
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
        if (!$expression instanceof LValueExpression) {
            throw new \Exception('Can only increment LValue');
        }
        return new PostfixIncrementExpression($expression);
    }

    protected function reducePostfixDecrementExpression($expression)
    {
        if (!$expression instanceof LValueExpression) {
            throw new \Exception('Can only decrement LValue');
        }
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
        if (!$expression instanceof LValueExpression) {
            throw new \Exception('Can only increment LValue');
        }
        return new PrefixIncrementExpression($expression);
    }

    protected function reducePrefixDecrementExpression($expression)
    {
        if (!$expression instanceof LValueExpression) {
            throw new \Exception('Can only decrement LValue');
        }
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
        if (!$expression instanceof LValueExpression) {
            throw new \Exception('Can only delete LValue');
        }
        return new DeleteExpression($expression);
    }

    protected function reduceAwaitExpression($expression)
    {
        return new AwaitExpression($expression);
    }

    protected function reduceExponentExpression($left, $right)
    {
        return new ExponentExpression($left, $right);
    }

    protected function reduceMultiplyExpression($left, $right)
    {
        return new MultiplyExpression($left, $right);
    }

    protected function reduceDivideExpression($left, $right)
    {
        return new DivideExpression($left, $right);
    }

    protected function reduceModuloExpression($left, $right)
    {
        return new ModuloExpression($left, $right);
    }

    protected function reduceAddExpression($left, $right)
    {
        return new AddExpression($left, $right);
    }

    protected function reduceSubtractExpression($left, $right)
    {
        return new SubtractExpression($left, $right);
    }

    protected function reduceBitwiseLeftShiftExpression($left, $right)
    {
        return new BitwiseLeftShiftExpression($left, $right);
    }

    protected function reduceBitwiseRightShiftExpression($left, $right)
    {
        return new BitwiseRightShiftExpression($left, $right);
    }

    protected function reduceBitwiseUnsignedRightShiftExpression($left, $right)
    {
        return new BitwiseUnsignedRightShiftExpression($left, $right);
    }

    protected function reduceYieldExpression($expression)
    {
        return new YieldExpression($expression);
    }

    protected function reduceYieldStarExpression($expression)
    {
        return new YieldStarExpression($expression);
    }

    protected function reduceLessThanExpression($left, $right)
    {
        return new LessThanExpression($left, $right);
    }

    protected function reduceLessThanOrEqualExpression($left, $right)
    {
        return new LessThanOrEqualExpression($left, $right);
    }

    protected function reduceGreaterThanExpression($left, $right)
    {
        return new GreaterThanExpression($left, $right);
    }

    protected function reduceGreaterThanOrEqualExpression($left, $right)
    {
        return new GreaterThanOrEqualExpression($left, $right);
    }

    protected function reduceInExpression($left, $right)
    {
        return new InExpression($left, $right);
    }

    protected function reduceInstanceofExpression($left, $right)
    {
        return new InstanceofExpression($left, $right);
    }

    protected function reduceEqualityExpression($left, $right)
    {
        return new EqualityExpression($left, $right);
    }

    protected function reduceInqualityExpression($left, $right)
    {
        return new InequalityExpression($left, $right);
    }

    protected function reduceStrictEqualityExpression($left, $right)
    {
        return new StrictEqualityExpression($left, $right);
    }

    protected function reduceStrictInqualityExpression($left, $right)
    {
        return new StrictInequalityExpression($left, $right);
    }

    protected function reduceBitwiseAndExpression($left, $right)
    {
        return new BitwiseAndExpression($left, $right);
    }

    protected function reduceBitwiseXorExpression($left, $right)
    {
        return new BitwiseXorExpression($left, $right);
    }

    protected function reduceBitwiseOrExpression($left, $right)
    {
        return new BitwiseOrExpression($left, $right);
    }

    protected function reduceLogicalAndExpression($left, $right)
    {
        return new LogicalAndExpression($left, $right);
    }

    protected function reduceLogicalOrExpression($left, $right)
    {
        return new LogicalOrExpression($left, $right);
    }

    protected function reduceAssignmentExpression($left, $right)
    {
        return new AssignmentExpression($left, $right);
    }

    protected function reduceAddAssignmentExpression($left, $right)
    {
        return new AddAssignmentExpression($left, $right);
    }

    protected function reduceSubtractAssignmentExpression($left, $right)
    {
        return new SubtractAssignmentExpression($left, $right);
    }

    protected function reduceExponentAssignmentExpression($left, $right)
    {
        return new ExponentAssignmentExpression($left, $right);
    }

    protected function reduceMultiplyAssignmentExpression($left, $right)
    {
        return new MultiplyAssignmentExpression($left, $right);
    }

    protected function reduceDivideAssignmentExpression($left, $right)
    {
        return new DivideAssignmentExpression($left, $right);
    }

    protected function reduceModuloAssignmentExpression($left, $right)
    {
        return new ModuloAssignmentExpression($left, $right);
    }

    protected function reduceBitwiseLeftShiftAssignmentExpression($left, $right)
    {
        return new BitwiseLeftShiftAssignmentExpression($left, $right);
    }

    protected function reduceBitwiseRightShiftAssignmentExpression($left, $right)
    {
        return new BitwiseRightShiftAssignmentExpression($left, $right);
    }

    protected function reduceBitwiseUnsignedRightShiftAssignmentExpression($left, $right)
    {
        return new BitwiseUnsignedRightShiftAssignmentExpression($left, $right);
    }

    protected function reduceBitwiseAndAssignmentExpression($left, $right)
    {
        return new BitwiseAndAssignmentExpression($left, $right);
    }

    protected function reduceBitwiseXorAssignmentExpression($left, $right)
    {
        return new BitwiseXorAssignmentExpression($left, $right);
    }

    protected function reduceBitwiseOrAssignmentExpression($left, $right)
    {
        return new BitwiseOrAssignmentExpression($left, $right);
    }

    protected function reduceConditionalExpression($condition, $if, $else)
    {
        return new ConditionalExpression($condition, $if, $else);
    }

    protected function reduceNamedFunctionExpression($name, $parameters, $body)
    {
        return new FunctionDefinitionExpression(new FunctionDefinitionNode($name[0], $parameters, $body));
    }

    protected function reduceAnonymousFunctionExpression($parameters, $body)
    {
        return new FunctionDefinitionExpression(new FunctionDefinitionNode(null, $parameters, $body));
    }

    protected function reduceParameterNode($name)
    {
        return new FunctionParameterNode($name[0]);
    }

    protected function reduceDoubleQuotedStringExpression($str) {
        return StringExpression::fromExpression($str[0]);
    }

    protected function reduceSingleQuotedStringExpression($str) {
        return StringExpression::fromExpression($str[0]);
    }

    protected function reduceRegexExpression($str) {
        return RegexExpression::fromExpression($str[0]);
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

    protected function reduceArray($items) {
        if ($items[0] === '[') {
            $items = [];
        }
        return new ArrayExpression($items);
    }

    protected function reduceObject($items) {
        if ($items[0] === '{') {
            $items = [];
        }
        return new ObjectExpression($items);
    }

    protected function reduceObjectItem($key, $value) {
        if (is_array($key)) {
            $key = new StringExpression($key[0]);
        }
        return new ObjectItemNode($key, $value);
    }

    protected function reduceConstantExpression($token) {
        switch ($token[0]) {
            case 'null':
                return ConstantExpression::nullConstant();
            case 'NaN':
                return ConstantExpression::nanConstant();
            case 'true':
                return ConstantExpression::trueConstant();
            case 'false':
                return ConstantExpression::trueConstant();
            case 'undefined':
                return ConstantExpression::undefinedConstant();
            default:
                throw new \Exception('Unknown constant: ' . $token[0]);
        }
    }
}
