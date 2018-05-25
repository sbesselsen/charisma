<?php

namespace Charisma\Parser\Reducer;

use Charisma\Parser\Node\Expression\Expression;
use Charisma\Parser\Node\Statement\ExpressionStatement;

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
}
