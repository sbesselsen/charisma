<?php

namespace Charisma\Parser\Node;

use Charisma\Parser\Node\Statement\Statement;

final class CodeBlockNode extends Node
{
    /**
     * The statements.
     *
     * @var Statement[]
     *   The statements.
     */
    public $statements;

    /**
     * CodeBlockNode constructor.
     * @param Statement[] $statements
     */
    public function __construct(array $statements)
    {
        $this->statements = $statements;
    }
}
