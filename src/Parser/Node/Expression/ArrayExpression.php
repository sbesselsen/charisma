<?php

namespace Charisma\Parser\Node\Expression;

final class ArrayExpression extends Expression
{
    /**
     * The items of the array.
     *
     * @var Expression[]
     *   The items.
     */
    public $items;

    /**
     * ArrayExpression constructor.
     * @param Expression[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }
}
