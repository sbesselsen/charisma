<?php

namespace Charisma\Parser\Node\Statement;

use Charisma\Parser\Node\CodeBlockNode;

final class TryCatchStatement extends Statement
{
    /**
     * The try block.
     *
     * @var CodeBlockNode
     *   The try block.
     */
    public $try;

    /**
     * The variable name for exceptions.
     *
     * @var string
     *   The name.
     */
    public $exceptionVariableName;

    /**
     * The catch block.
     *
     * @var CodeBlockNode
     *   The catch block.
     */
    public $catch;

    /**
     * TryCatchStatement constructor.
     * @param CodeBlockNode $try
     * @param string $exceptionVariableName
     * @param CodeBlockNode $catch
     */
    public function __construct(CodeBlockNode $try, string $exceptionVariableName, CodeBlockNode $catch)
    {
        $this->try = $try;
        $this->exceptionVariableName = $exceptionVariableName;
        $this->catch = $catch;
    }
}
