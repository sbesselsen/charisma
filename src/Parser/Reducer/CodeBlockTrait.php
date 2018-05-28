<?php

namespace Charisma\Parser\Reducer;

use Charisma\Parser\Node\CodeBlockNode;

trait CodeBlockTrait
{
    protected function reduceCodeBlock($items)
    {
        return new CodeBlockNode($items);
    }
}
