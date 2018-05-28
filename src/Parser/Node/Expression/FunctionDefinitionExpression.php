<?php

namespace Charisma\Parser\Node\Expression;

use Charisma\Parser\Node\FunctionDefinitionNode;

final class FunctionDefinitionExpression extends Expression
{
    /**
     * The function definition.
     *
     * @var FunctionDefinitionNode
     *   The definition.
     */
    public $functionDefinition;

    /**
     * FunctionCallExpression constructor.
     * @param FunctionDefinitionNode $functionDefinition
     */
    public function __construct(FunctionDefinitionNode $functionDefinition)
    {
        $this->functionDefinition = $functionDefinition;
    }
}
