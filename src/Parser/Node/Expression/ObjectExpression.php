<?php

namespace Charisma\Parser\Node\Expression;

use Charisma\Parser\Node\ObjectItemNode;

final class ObjectExpression extends Expression
{
    /**
     * The items in the object.
     *
     * @var ObjectItemNode[]
     *   The items.
     */
    public $items;

    /**
     * ArrayExpression constructor.
     * @param ObjectItemNode[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }
}
