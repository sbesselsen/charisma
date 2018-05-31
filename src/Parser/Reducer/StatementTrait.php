<?php

namespace Charisma\Parser\Reducer;

use Charisma\Parser\Node\CodeBlockNode;
use Charisma\Parser\Node\Expression\Expression;
use Charisma\Parser\Node\FunctionDefinitionNode;
use Charisma\Parser\Node\Statement\DoWhileStatement;
use Charisma\Parser\Node\Statement\ExpressionStatement;
use Charisma\Parser\Node\Statement\ForStatement;
use Charisma\Parser\Node\Statement\FunctionDeclarationStatement;
use Charisma\Parser\Node\Statement\IfStatement;
use Charisma\Parser\Node\Statement\WhileStatement;

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
}
