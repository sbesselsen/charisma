<?php

namespace Charisma\Parser\Reducer;

use Charisma\Parser\Node\Expression\NumberExpression;

trait ExpressionTrait
{
    protected function reduceIntegerNumberExpression($p0)
    {
        return new NumberExpression((int)$p0[0]);
    }

    protected function reduceFloatNumberExpression($p0)
    {
        return new NumberExpression((double)$p0[0]);
    }

    protected function reduceOctalNumberExpression($p0)
    {
        return new NumberExpression((int)octdec($p0[0]));
    }
}
