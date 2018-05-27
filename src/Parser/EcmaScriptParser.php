<?php

namespace Charisma\Parser;

use Charisma\Parser\Reducer\CodeBlockTrait;
use Charisma\Parser\Reducer\ExpressionTrait;
use Charisma\Parser\Reducer\StatementTrait;

final class EcmaScriptParser extends AbstractEcmaScriptParser
{
    use CodeBlockTrait;
    use ExpressionTrait;
    use StatementTrait;

    protected function arrayPush($p0, $p1)
    {
        $p0[] = $p1;
        return $p0;
    }

    protected function arrayOf($p0)
    {
        return [$p0];
    }

    protected function emptyArray($p0)
    {
        return [];
    }

    protected function debugLog($message)
    {
        echo '> ' . $message . PHP_EOL;
    }
}
