<?php

namespace Charisma\Parser\Node\Statement;

use Charisma\Parser\Node\CodeBlockNode;
use Charisma\Parser\Node\Expression\Expression;

final class ForStatement extends Statement
{
    /**
     * The pre statement.
     *
     * @var Statement|null
     *   The statement.
     */
    public $pre;

    /**
     * The loop condition.
     *
     * @var Expression
     *   The expression.
     */
    public $condition;

    /**
     * The post expression.
     *
     * @var Expression|null
     *   The expression.
     */
    public $post;

    /**
     * The code block to execute while the condition evaluates to true.
     *
     * @var CodeBlockNode
     *   The code block.
     */
    public $codeBlock;

    /**
     * ForStatement constructor.
     * @param Expression $condition
     * @param CodeBlockNode $codeBlock
     * @param Statement|null $pre
     * @param Expression|null $post
     */
    public function __construct(Expression $condition, CodeBlockNode $codeBlock, Statement $pre = null, Expression $post = null)
    {
        $this->condition = $condition;
        $this->codeBlock = $codeBlock;
        $this->pre = $pre;
        $this->post = $post;
    }
}
