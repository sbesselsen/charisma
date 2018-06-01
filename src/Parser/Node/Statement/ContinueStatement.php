<?php

namespace Charisma\Parser\Node\Statement;

final class ContinueStatement extends Statement
{
    /**
     * The label of the loop to break from.
     *
     * @var string|null
     *   The label.
     */
    public $label;

    /**
     * ContinueStatement constructor.
     * @param string|null $label
     */
    public function __construct($label)
    {
        $this->label = $label;
    }
}
