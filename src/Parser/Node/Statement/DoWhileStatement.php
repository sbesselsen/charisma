<?php

namespace Charisma\Parser\Node\Statement;

use Charisma\Parser\Node\CodeBlockNode;
use Charisma\Parser\Node\Expression\Expression;

final class DoWhileStatement extends Statement
{
    /**
     * The condition.
     *
     * @var Expression
     *   The expression.
     */
    public $condition;

    /**
     * The code block to execute while the condition evaluates to true.
     *
     * @var CodeBlockNode
     *   The code block.
     */
    public $codeBlock;

    /**
     * DoWhileStatement constructor.
     * @param Expression $condition
     * @param CodeBlockNode $codeBlock
     */
    public function __construct(Expression $condition, $codeBlock)
    {
        $this->condition = $condition;
        $this->codeBlock = $codeBlock;
    }
}
