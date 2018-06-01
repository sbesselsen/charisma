<?php

namespace Charisma\Parser\Node;

use Charisma\Parser\Node\Expression\Expression;

final class ObjectItemNode extends Node
{
    /**
     * The key.
     *
     * @var Expression
     *   The key.
     */
    public $key;

    /**
     * The value.
     *
     * @var Expression
     *   The value.
     */
    public $value;

    /**
     * ObjectItemNode constructor.
     * @param Expression $key
     * @param Expression $value
     */
    public function __construct(Expression $key, Expression $value)
    {
        $this->key = $key;
        $this->value = $value;
    }
}
