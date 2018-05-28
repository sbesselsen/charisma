<?php

namespace Charisma\Parser\Reducer;

use Charisma\Parser\Node\Expression\Expression;
use Charisma\Parser\Node\FunctionDefinitionNode;
use Charisma\Parser\Node\Statement\ExpressionStatement;
use Charisma\Parser\Node\Statement\FunctionDeclarationStatement;

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

    protected function reduceFunctionDeclarationStatement($name, $parameters, $body)
    {
        return new FunctionDeclarationStatement(new FunctionDefinitionNode($name[0], $parameters, $body));
    }
}
