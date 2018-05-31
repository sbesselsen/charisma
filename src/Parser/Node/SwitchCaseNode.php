<?php

namespace Charisma\Parser\Node;

use Charisma\Parser\Node\Expression\Expression;
use Charisma\Parser\Node\Statement\Statement;

final class SwitchCaseNode extends Node
{
    /**
     * The expression. This is null for the default case.
     *
     * @var Expression|null
     *   The expression.
     */
    public $expression;

    /**
     * The statements.
     *
     * @var Statement[]
     *   The statements.
     */
    public $statements;

    /**
     * SwitchCaseNode constructor.
     * @param Expression|null $expression
     * @param Statement[] $statements
     */
    public function __construct(Expression $expression = null, array $statements)
    {
        $this->expression = $expression;
        $this->statements = $statements;
    }
}
