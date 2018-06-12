<?php

namespace Charisma\Parser\Node\Expression;

final class StringExpression extends ValueExpression
{
    /**
     * The value.
     *
     * @var string
     *   The value.
     */
    public $value;

    /**
     * StringExpression constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        if ($value{0} === "'") {
            $this->value = self::unescapeSingleQuoted(substr($value, 1, -1));
        } else {
            $this->value = self::unescapeDoubleQuoted(substr($value, 1, -1));
        }
    }

    /**
     * @param string $content
     *
     * @return string
     */
    private static function unescapeSingleQuoted(string $content) {
        $pattern = '([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])';
        preg_match_all($pattern, $content, $matches);
        $output = [];
        foreach ($matches[0] as $match) {
            if ($match{0} === '\\') {
                $output[] = $match{1};
            } else {
                $output[] = $match;
            }
        };
        return implode('', $output);
    }

    /**
     * @param string $content
     *
     * @return string
     */
    private static function unescapeDoubleQuoted(string $content) {
        $pattern = '([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])';
        preg_match_all($pattern, $content, $matches);
        $output = [];
        foreach ($matches[0] as $match) {
            if ($match{0} === '\\') {
                $output[] = $match{1};
            } else {
                $output[] = $match;
            }
        };
        return implode('', $output);
    }
}
