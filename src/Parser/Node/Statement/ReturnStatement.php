<?php

namespace Charisma\Parser\Node\Statement;

use Charisma\Parser\Node\Expression\Expression;

final class ReturnStatement extends Statement
{
    /**
     * The return value.
     *
     * @var Expression|null
     *   The value.
     */
    public $value;

    /**
     * ReturnStatement constructor.
     * @param Expression|null $value
     */
    public function __construct(Expression $value = null)
    {
        $this->value = $value;
    }
}
