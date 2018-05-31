<?php

namespace Charisma\Parser\Node\Expression;

final class ConstantExpression extends ValueExpression
{
    /**
     * @var ConstantExpression
     */
    private static $null;

    /**
     * @var ConstantExpression
     */
    private static $undefined;

    /**
     * @var ConstantExpression
     */
    private static $true;

    /**
     * @var ConstantExpression
     */
    private static $false;

    /**
     * @var ConstantExpression
     */
    private static $nan;

    /**
     * The description.
     *
     * @var string
     *   The description.
     */
    private $description;

    /**
     * ConstantExpression constructor.
     * @param string $description
     */
    private function __construct(string $description)
    {
        $this->description = $description;
    }

    public static function nullConstant(): ConstantExpression
    {
        return self::$null ?? (self::$null = new static('null'));
    }

    public static function undefinedConstant(): ConstantExpression
    {
        return self::$undefined ?? (self::$undefined = new static('undefined'));
    }

    public static function trueConstant(): ConstantExpression
    {
        return self::$true ?? (self::$true = new static('true'));
    }

    public static function falseConstant(): ConstantExpression
    {
        return self::$false ?? (self::$false = new static('false'));
    }

    public static function nanConstant(): ConstantExpression
    {
        return self::$nan ?? (self::$nan = new static('NaN'));
    }
}
