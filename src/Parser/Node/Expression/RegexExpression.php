<?php

namespace Charisma\Parser\Node\Expression;

final class RegexExpression extends ValueExpression
{
    /**
     * The pattern.
     *
     * @var string
     *   The pattern.
     */
    public $pattern;

    /**
     * The flags.
     *
     * @var string
     *   The flags.
     */
    public $flags;

    /**
     * RegexExpression constructor.
     * @param string $pattern
     * @param string $flags
     */
    public function __construct(string $pattern, string $flags)
    {
        $this->pattern = $pattern;
        $this->flags = $flags;
    }

    /**
     * @param string $expression
     *
     * @return RegexExpression
     */
    public static function fromExpression(string $expression): RegexExpression {
        $flags = '';
        if (preg_match('(/([a-zA-Z0-9]+)$)', $expression, $match)) {
            $flags = $match[1];
            $expression = substr($expression, 0, -1 * strlen($flags));
        }
        $expression = substr($expression, 1, -1);
        $pattern = '([^\\\\\\/]+|\\\\\\\\|\\\\\\/|\\\\[^\\/])';
        preg_match_all($pattern, $expression, $matches);
        $output = [];
        foreach ($matches[0] as $match) {
            if ($match{0} === '\\') {
                $output[] = $match{1};
            } else {
                $output[] = $match;
            }
        };
        $pattern = implode('', $output);
        
        return new static($pattern, $flags);
    }
}
