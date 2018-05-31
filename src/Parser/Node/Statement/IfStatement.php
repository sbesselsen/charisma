<?php

namespace Charisma\Parser\Node\Statement;

use Charisma\Parser\Node\CodeBlockNode;
use Charisma\Parser\Node\Expression\Expression;

final class IfStatement extends Statement
{
    /**
     * The condition.
     *
     * @var Expression
     *   The expression.
     */
    public $condition;

    /**
     * The code block to execute if the condition evaluates to true.
     *
     * @var CodeBlockNode
     *   The code block.
     */
    public $codeBlock;

    /**
     * The else.
     *
     * @var IfStatement|CodeBlockNode|null
     *   The else.
     */
    public $else;

    /**
     * IfStatement constructor.
     * @param Expression $condition
     * @param CodeBlockNode $codeBlock
     * @param IfStatement|CodeBlockNode|null $else
     */
    public function __construct(Expression $condition, $codeBlock, $else = null)
    {
        $this->condition = $condition;
        $this->codeBlock = $codeBlock;
        $this->else = $else;
    }
}
