<?php

namespace Charisma\Parser\Node;

final class FunctionParameterNode extends Node
{
    /**
     * The parameter name.
     *
     * @var string
     *   The name.
     */
    public $name;

    /**
     * FunctionParameterNode constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
