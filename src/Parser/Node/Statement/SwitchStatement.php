<?php

namespace Charisma\Parser\Node\Statement;

use Charisma\Parser\Node\Expression\Expression;
use Charisma\Parser\Node\SwitchCaseNode;

final class SwitchStatement extends Statement
{
    /**
     * The expression.
     *
     * @var Expression
     *   The expression.
     */
    public $expression;

    /**
     * The cases.
     *
     * @var SwitchCaseNode[]
     *   The cases.
     */
    public $cases;

    /**
     * SwitchStatement constructor.
     * @param Expression $expression
     * @param SwitchCaseNode[] $cases
     */
    public function __construct(Expression $expression, array $cases)
    {
        $this->expression = $expression;
        $this->cases = $cases;
    }
}
