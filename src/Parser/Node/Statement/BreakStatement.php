<?php

namespace Charisma\Parser\Node\Statement;

final class BreakStatement extends Statement
{
    /**
     * The label of the loop to break from.
     *
     * @var string|null
     *   The label.
     */
    public $label;

    /**
     * BreakStatement constructor.
     * @param string|null $label
     */
    public function __construct($label)
    {
        $this->label = $label;
    }
}
