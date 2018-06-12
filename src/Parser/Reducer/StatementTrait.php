<?php

namespace Charisma\Parser\Reducer;

use Charisma\Parser\Node\CodeBlockNode;
use Charisma\Parser\Node\Expression\Expression;
use Charisma\Parser\Node\FunctionDefinitionNode;
use Charisma\Parser\Node\Statement\BreakStatement;
use Charisma\Parser\Node\Statement\ContinueStatement;
use Charisma\Parser\Node\Statement\DoWhileStatement;
use Charisma\Parser\Node\Statement\ExpressionStatement;
use Charisma\Parser\Node\Statement\ForStatement;
use Charisma\Parser\Node\Statement\FunctionDeclarationStatement;
use Charisma\Parser\Node\Statement\IfStatement;
use Charisma\Parser\Node\Statement\LabeledStatement;
use Charisma\Parser\Node\Statement\ReturnStatement;
use Charisma\Parser\Node\Statement\SwitchStatement;
use Charisma\Parser\Node\Statement\TryCatchStatement;
use Charisma\Parser\Node\Statement\WhileStatement;
use Charisma\Parser\Node\SwitchCaseNode;

trait StatementTrait
{
    /**
     * @param Expression $expression
     *
     * @return ExpressionStatement
     */
    protected function reduceExpressionStatement($expression): ExpressionStatement
    {
        return new ExpressionStatement($expression);
    }

    protected function reduceFunctionDeclarationStatement($name, $parameters, $body): FunctionDeclarationStatement
    {
        return new FunctionDeclarationStatement(new FunctionDefinitionNode($name[0], $parameters, $body));
    }

    protected function reduceIfStatement($condition, $codeBlock, $else = null): IfStatement {
        if ($else instanceof CodeBlockNode && isset ($else->statements[0]) && $else->statements[0] instanceof IfStatement) {
            $else = $else->statements[0];
        }
        return new IfStatement($condition, $codeBlock, $else);
    }

    protected function reduceWhileStatement($condition, $codeBlock): WhileStatement {
        return new WhileStatement($condition, $codeBlock);
    }

    protected function reduceDoWhileStatement($condition, $codeBlock): DoWhileStatement {
        return new DoWhileStatement($condition, $codeBlock);
    }

    protected function reduceForStatement($pre, $condition, $post, $codeBlock): ForStatement {
        if (is_array($pre)) {
            $pre = null;
        }
        if (is_array($post)) {
            $post = null;
        }
        return new ForStatement($condition, $codeBlock, $pre, $post);
    }

    protected function reduceSwitchStatement($expression, $cases = []): SwitchStatement {
        return new SwitchStatement($expression, $cases);
    }

    protected function reduceSwitchCase($expression, $statements = []): SwitchCaseNode {
        return new SwitchCaseNode($expression, $statements);
    }

    protected function reduceSwitchDefault($_, $statements = []): SwitchCaseNode {
        return new SwitchCaseNode(null, $statements);
    }

    protected function reduceReturnStatement($_, $value = null): ReturnStatement {
        return new ReturnStatement($value);
    }

    protected function reduceBreakStatement($_, $label = null): BreakStatement {
        return new BreakStatement($label ? $label[0] : null);
    }

    protected function reduceContinueStatement($_, $label = null): ContinueStatement {
        return new ContinueStatement($label ? $label[0] : null);
    }

    protected function reduceLabeledStatement($label, $statement): LabeledStatement {
        return new LabeledStatement(preg_replace('(\s*:$)', '', $label[0]), $statement);
    }

    protected function reduceTryCatch($try, $variable, $catch): TryCatchStatement {
        return new TryCatchStatement($try, $variable[0], $catch);
    }
}
