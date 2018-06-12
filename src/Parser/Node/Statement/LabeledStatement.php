<?php

namespace Charisma\Parser\Node\Statement;

final class LabeledStatement extends Statement
{
    /**
     * The label.
     *
     * @var string
     *   The label.
     */
    public $label;

    /**
     * The statement.
     *
     * @var Statement
     *   The statement.
     */
    public $statement;

    /**
     * LabeledStatement constructor.
     * @param string $label
     * @param Statement $statement
     */
    public function __construct(string $label, Statement $statement)
    {
        $this->label = $label;
        $this->statement = $statement;
    }
}
