<?php

namespace Charisma\Parser\Node\Statement;

use Charisma\Parser\Node\FunctionDefinitionNode;

final class FunctionDeclarationStatement extends Statement
{
    /**
     * The function definition.
     *
     * @var FunctionDefinitionNode
     *   The function definition.
     */
    public $functionDefinition;

    /**
     * FunctionDeclarationStatement constructor.
     * @param FunctionDefinitionNode $functionDefinition
     */
    public function __construct(FunctionDefinitionNode $functionDefinition)
    {
        $this->functionDefinition = $functionDefinition;
    }
}
