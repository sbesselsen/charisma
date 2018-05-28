<?php

namespace Charisma\Parser\Node;

final class FunctionDefinitionNode extends Node
{
    /**
     * The name.
     *
     * @var string|null
     *   The name.
     */
    public $name;

    /**
     * The parameters.
     *
     * @var FunctionParameterNode[]
     *   The parameters.
     */
    public $parameters;

    /**
     * The body.
     *
     * @var CodeBlockNode
     *   The body.
     */
    public $body;

    /**
     * FunctionDefinitionNode constructor.
     * @param $name
     * @param FunctionParameterNode[] $parameters
     * @param CodeBlockNode $body
     */
    public function __construct($name, array $parameters, CodeBlockNode $body)
    {
        $this->name = ($name === null) ? null : ((string)$name);
        $this->parameters = $parameters;
        $this->body = $body;
    }
}
