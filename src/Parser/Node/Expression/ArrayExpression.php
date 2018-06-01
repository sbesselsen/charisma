<?php

namespace Charisma\Parser\Node\Expression;

final class ArrayExpression extends Expression
{
    /**
     * The elements of the array.
     *
     * @var Expression[]
     *   The elements.
     */
    public $elements;

    /**
     * ArrayExpression constructor.
     * @param Expression[] $elements
     */
    public function __construct(array $elements)
    {
        $this->elements = $elements;
    }
}
