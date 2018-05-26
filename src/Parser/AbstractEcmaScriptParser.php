<?php

namespace Charisma\Parser;

abstract class AbstractEcmaScriptParser
{
    public function parse(string $string)
    {
        $sts = array(0);
        $os = array();
        $o = 0;
        $l = strlen($string);
        if (($ml = strspn($string, '
	 ', $o)) > 0) {
            $o += $ml;
        }
        goto st0;
        st0:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
                $sts[] = 4;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st4;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st1:
        if ($o === $l) {
            $r0 = array_pop($os);
            return $r0;
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect end of string at line ' . $el . ', column ' . $ec);
        st2:
        if ($o === $l) {
            $r0 = array_pop($os);
            $os[] = $this->reduceCodeBlockContent($r0);
            array_pop($sts);
            goto gt0;
        }
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, '}', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceCodeBlockContent($r0);
                array_pop($sts);
                goto gt0;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $sts[] = 37;
                $os[] = array(';');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
                $sts[] = 36;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st36;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), end of string or } at line ' . $el . ', column ' . $ec);
        st3:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array(';');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ; at line ' . $el . ', column ' . $ec);
        st4:
        if ($o === $l) {
            $r0 = array_pop($os);
            $os[] = $this->emptyArray($r0);
            array_pop($sts);
            goto gt1;
        }
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '}', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, !, ~, +, -, ++, --, typeof, void, delete, await, (, new, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), end of string or } at line ' . $el . ', column ' . $ec);
        st5:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceExpressionStatement($r0);
                array_pop($sts);
                goto gt2;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ; at line ' . $el . ', column ' . $ec);
        st6:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st7:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 41;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st41;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 40;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st40;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st8:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st9:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st10:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 44;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st44;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 46;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st46;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 42;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st42;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 43;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st43;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 45;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st45;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ++, --, (, ., [, ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st11:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st12:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st13:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st14:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st15:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st16:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st17:
        if ($l > $o) {
            if (($ml = strspn($string, '
	 ', $o)) > 0) {
                $sts[] = 53;
                $os[] = array(substr($string, $o, $ml));
                $o += $ml;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st53;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect  at line ' . $el . ', column ' . $ec);
        st18:
        if ($l > $o) {
            if (($ml = strspn($string, '
	 ', $o)) > 0) {
                $sts[] = 54;
                $os[] = array(substr($string, $o, $ml));
                $o += $ml;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st54;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect  at line ' . $el . ', column ' . $ec);
        st19:
        if ($l > $o) {
            if (($ml = strspn($string, '
	 ', $o)) > 0) {
                $sts[] = 55;
                $os[] = array(substr($string, $o, $ml));
                $o += $ml;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st55;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect  at line ' . $el . ', column ' . $ec);
        st20:
        if ($l > $o) {
            if (($ml = strspn($string, '
	 ', $o)) > 0) {
                $sts[] = 56;
                $os[] = array(substr($string, $o, $ml));
                $o += $ml;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st56;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect  at line ' . $el . ', column ' . $ec);
        st21:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 58;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st58;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 57;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st57;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st22:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st23:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 61;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st61;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 60;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st60;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st24:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt6;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st25:
        if ($l > $o) {
            if (($ml = strspn($string, '
	 ', $o)) > 0) {
                $sts[] = 62;
                $os[] = array(substr($string, $o, $ml));
                $o += $ml;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st62;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect  at line ' . $el . ', column ' . $ec);
        st26:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ), (, ++, -- or , at line ' . $el . ', column ' . $ec);
        st27:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ), (, ++, -- or , at line ' . $el . ', column ' . $ec);
        st28:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ), (, ++, -- or , at line ' . $el . ', column ' . $ec);
        st29:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt10;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st30:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st31:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st32:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st33:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt14;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt14;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt14;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt14;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt14;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt14;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt14;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt14;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt14;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ), (, ++, -- or , at line ' . $el . ', column ' . $ec);
        st34:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceDoubleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt15;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceDoubleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt15;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceDoubleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt15;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceDoubleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt15;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceDoubleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt15;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceDoubleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt15;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st35:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceSingleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt15;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceSingleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt15;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceSingleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt15;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceSingleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt15;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceSingleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt15;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceSingleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt15;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st36:
        if ($o === $l) {
            $r1 = array_pop($os);
            $r0 = array_pop($os);
            $os[] = $r0;
            array_pop($sts);
            array_pop($sts);
            goto gt1;
        }
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '}', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, !, ~, +, -, ++, --, typeof, void, delete, await, (, new, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), end of string or } at line ' . $el . ', column ' . $ec);
        st37:
        if ($o === $l) {
            $r1 = array_pop($os);
            $r0 = array_pop($os);
            $os[] = $r0;
            array_pop($sts);
            array_pop($sts);
            goto gt1;
        }
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '}', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, !, ~, +, -, ++, --, typeof, void, delete, await, (, new, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), end of string or } at line ' . $el . ', column ' . $ec);
        st38:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $sts[] = 63;
                $os[] = array(';');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st63;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ; at line ' . $el . ', column ' . $ec);
        st39:
        if ($o === $l) {
            $r1 = array_pop($os);
            $r0 = array_pop($os);
            $os[] = $this->arrayOf($r0);
            array_pop($sts);
            array_pop($sts);
            goto gt1;
        }
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '}', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, !, ~, +, -, ++, --, typeof, void, delete, await, (, new, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), end of string or } at line ' . $el . ', column ' . $ec);
        st40:
        if ($l > $o) {
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 64;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st64;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st41:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st42:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st43:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st44:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $sts[] = 67;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st67;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ), !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st45:
        if ($l > $o) {
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 69;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st69;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st46:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st47:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st48:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceBitwiseNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceBitwiseNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceBitwiseNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceBitwiseNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st49:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryPlusExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryPlusExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryPlusExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryPlusExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st50:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryNegationExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryNegationExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryNegationExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryNegationExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st51:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixIncrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixIncrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixIncrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixIncrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st52:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixDecrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixDecrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixDecrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixDecrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st53:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st54:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st55:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), (, STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st56:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st57:
        if ($l > $o) {
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 78;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st78;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st58:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st59:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $sts[] = 80;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st80;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ) at line ' . $el . ', column ' . $ec);
        st60:
        if ($l > $o) {
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 81;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st81;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st61:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st62:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect (, new, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st63:
        if ($o === $l) {
            $r2 = array_pop($os);
            $r1 = array_pop($os);
            $r0 = array_pop($os);
            $os[] = $this->arrayPush($r0, $r1);
            array_pop($sts);
            array_pop($sts);
            array_pop($sts);
            goto gt1;
        }
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '}', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, !, ~, +, -, ++, --, typeof, void, delete, await, (, new, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), end of string or } at line ' . $el . ', column ' . $ec);
        st64:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ), (, ++, -- or , at line ' . $el . ', column ' . $ec);
        st65:
        if ($l > $o) {
            if (substr_compare($string, ']', $o, 1) === 0) {
                $sts[] = 87;
                $os[] = array(']');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st87;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ] at line ' . $el . ', column ' . $ec);
        st66:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $sts[] = 88;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st88;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $sts[] = 89;
                $os[] = array(',');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st89;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ) or , at line ' . $el . ', column ' . $ec);
        st67:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st68:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                goto gt16;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                goto gt16;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ) or , at line ' . $el . ', column ' . $ec);
        st69:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ), (, ++, -- or , at line ' . $el . ', column ' . $ec);
        st70:
        if ($l > $o) {
            if (substr_compare($string, ']', $o, 1) === 0) {
                $sts[] = 90;
                $os[] = array(']');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st90;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ] at line ' . $el . ', column ' . $ec);
        st71:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceTypeofExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceTypeofExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceTypeofExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceTypeofExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st72:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceVoidExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceVoidExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceVoidExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceVoidExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st73:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 44;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st44;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceDeleteExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 46;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st46;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceDeleteExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceDeleteExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceDeleteExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 45;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st45;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, (, ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st74:
        if ($l > $o) {
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 41;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st41;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 40;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st40;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect . or [ at line ' . $el . ', column ' . $ec);
        st75:
        if ($l > $o) {
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 58;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st58;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 57;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st57;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect . or [ at line ' . $el . ', column ' . $ec);
        st76:
        if ($l > $o) {
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 61;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st61;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 60;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st60;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect . or [ at line ' . $el . ', column ' . $ec);
        st77:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceAwaitExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceAwaitExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceAwaitExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceAwaitExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st78:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ), (, ++, -- or , at line ' . $el . ', column ' . $ec);
        st79:
        if ($l > $o) {
            if (substr_compare($string, ']', $o, 1) === 0) {
                $sts[] = 91;
                $os[] = array(']');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st91;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ] at line ' . $el . ', column ' . $ec);
        st80:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], (, ) or , at line ' . $el . ', column ' . $ec);
        st81:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ), (, ++, -- or , at line ' . $el . ', column ' . $ec);
        st82:
        if ($l > $o) {
            if (substr_compare($string, ']', $o, 1) === 0) {
                $sts[] = 92;
                $os[] = array(']');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st92;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ] at line ' . $el . ', column ' . $ec);
        st83:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 93;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st93;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 41;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st41;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 40;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st40;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect (, ., [, ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st84:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 44;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st44;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 46;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st46;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 45;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st45;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect (, ., [, ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st85:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceConstructedNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 58;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st58;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceConstructedNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceConstructedNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceConstructedNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 57;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st57;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st86:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st87:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ), (, ++, -- or , at line ' . $el . ', column ' . $ec);
        st88:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ) or , at line ' . $el . ', column ' . $ec);
        st89:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st90:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ), (, ++, -- or , at line ' . $el . ', column ' . $ec);
        st91:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ), (, ++, -- or , at line ' . $el . ', column ' . $ec);
        st92:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt13;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ., [, ;, ], ), (, ++, -- or , at line ' . $el . ', column ' . $ec);
        st93:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 16;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 25;
                $os[] = array('new');
                $o += 3;
                goto st25;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 19;
                $os[] = array('delete');
                $o += 6;
                goto st19;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 17;
                $os[] = array('typeof');
                $o += 6;
                goto st17;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 18;
                $os[] = array('void');
                $o += 4;
                goto st18;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 20;
                $os[] = array('await');
                $o += 5;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 35;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, (, new, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st94:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt16;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt16;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ) or , at line ' . $el . ', column ' . $ec);
        st95:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $sts[] = 96;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st96;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $sts[] = 89;
                $os[] = array(',');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st89;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ) or , at line ' . $el . ', column ' . $ec);
        st96:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r5 = array_pop($os);
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2, $r4);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r5 = array_pop($os);
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2, $r4);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r5 = array_pop($os);
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2, $r4);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r5 = array_pop($os);
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2, $r4);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ], ) or , at line ' . $el . ', column ' . $ec);
        gt0:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 1;
                goto st1;
        }
        gt1:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 2;
                goto st2;
        }
        gt2:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 3;
                goto st3;
            case 2:
                $sts[] = 38;
                goto st38;
        }
        gt3:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 5;
                goto st5;
            case 2:
                $sts[] = 5;
                goto st5;
            case 11:
                $sts[] = 47;
                goto st47;
            case 12:
                $sts[] = 48;
                goto st48;
            case 13:
                $sts[] = 49;
                goto st49;
            case 14:
                $sts[] = 50;
                goto st50;
            case 15:
                $sts[] = 51;
                goto st51;
            case 16:
                $sts[] = 52;
                goto st52;
            case 22:
                $sts[] = 59;
                goto st59;
            case 41:
                $sts[] = 65;
                goto st65;
            case 44:
                $sts[] = 68;
                goto st68;
            case 46:
                $sts[] = 70;
                goto st70;
            case 53:
                $sts[] = 71;
                goto st71;
            case 54:
                $sts[] = 72;
                goto st72;
            case 56:
                $sts[] = 77;
                goto st77;
            case 58:
                $sts[] = 79;
                goto st79;
            case 61:
                $sts[] = 82;
                goto st82;
            case 89:
                $sts[] = 94;
                goto st94;
            case 93:
                $sts[] = 68;
                goto st68;
        }
        gt4:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 6;
                goto st6;
            case 2:
                $sts[] = 6;
                goto st6;
            case 11:
                $sts[] = 6;
                goto st6;
            case 12:
                $sts[] = 6;
                goto st6;
            case 13:
                $sts[] = 6;
                goto st6;
            case 14:
                $sts[] = 6;
                goto st6;
            case 15:
                $sts[] = 6;
                goto st6;
            case 16:
                $sts[] = 6;
                goto st6;
            case 22:
                $sts[] = 6;
                goto st6;
            case 41:
                $sts[] = 6;
                goto st6;
            case 44:
                $sts[] = 6;
                goto st6;
            case 46:
                $sts[] = 6;
                goto st6;
            case 53:
                $sts[] = 6;
                goto st6;
            case 54:
                $sts[] = 6;
                goto st6;
            case 56:
                $sts[] = 6;
                goto st6;
            case 58:
                $sts[] = 6;
                goto st6;
            case 61:
                $sts[] = 6;
                goto st6;
            case 89:
                $sts[] = 6;
                goto st6;
            case 93:
                $sts[] = 6;
                goto st6;
        }
        gt5:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 7;
                goto st7;
            case 2:
                $sts[] = 7;
                goto st7;
            case 11:
                $sts[] = 7;
                goto st7;
            case 12:
                $sts[] = 7;
                goto st7;
            case 13:
                $sts[] = 7;
                goto st7;
            case 14:
                $sts[] = 7;
                goto st7;
            case 15:
                $sts[] = 7;
                goto st7;
            case 16:
                $sts[] = 7;
                goto st7;
            case 22:
                $sts[] = 7;
                goto st7;
            case 41:
                $sts[] = 7;
                goto st7;
            case 44:
                $sts[] = 7;
                goto st7;
            case 46:
                $sts[] = 7;
                goto st7;
            case 53:
                $sts[] = 7;
                goto st7;
            case 54:
                $sts[] = 7;
                goto st7;
            case 55:
                $sts[] = 74;
                goto st74;
            case 56:
                $sts[] = 7;
                goto st7;
            case 58:
                $sts[] = 7;
                goto st7;
            case 61:
                $sts[] = 7;
                goto st7;
            case 62:
                $sts[] = 83;
                goto st83;
            case 89:
                $sts[] = 7;
                goto st7;
            case 93:
                $sts[] = 7;
                goto st7;
        }
        gt6:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 8;
                goto st8;
            case 2:
                $sts[] = 8;
                goto st8;
            case 11:
                $sts[] = 8;
                goto st8;
            case 12:
                $sts[] = 8;
                goto st8;
            case 13:
                $sts[] = 8;
                goto st8;
            case 14:
                $sts[] = 8;
                goto st8;
            case 15:
                $sts[] = 8;
                goto st8;
            case 16:
                $sts[] = 8;
                goto st8;
            case 22:
                $sts[] = 8;
                goto st8;
            case 41:
                $sts[] = 8;
                goto st8;
            case 44:
                $sts[] = 8;
                goto st8;
            case 46:
                $sts[] = 8;
                goto st8;
            case 53:
                $sts[] = 8;
                goto st8;
            case 54:
                $sts[] = 8;
                goto st8;
            case 56:
                $sts[] = 8;
                goto st8;
            case 58:
                $sts[] = 8;
                goto st8;
            case 61:
                $sts[] = 8;
                goto st8;
            case 89:
                $sts[] = 8;
                goto st8;
            case 93:
                $sts[] = 8;
                goto st8;
        }
        gt7:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 9;
                goto st9;
            case 2:
                $sts[] = 9;
                goto st9;
            case 11:
                $sts[] = 9;
                goto st9;
            case 12:
                $sts[] = 9;
                goto st9;
            case 13:
                $sts[] = 9;
                goto st9;
            case 14:
                $sts[] = 9;
                goto st9;
            case 15:
                $sts[] = 9;
                goto st9;
            case 16:
                $sts[] = 9;
                goto st9;
            case 22:
                $sts[] = 9;
                goto st9;
            case 41:
                $sts[] = 9;
                goto st9;
            case 44:
                $sts[] = 9;
                goto st9;
            case 46:
                $sts[] = 9;
                goto st9;
            case 53:
                $sts[] = 9;
                goto st9;
            case 54:
                $sts[] = 9;
                goto st9;
            case 56:
                $sts[] = 9;
                goto st9;
            case 58:
                $sts[] = 9;
                goto st9;
            case 61:
                $sts[] = 9;
                goto st9;
            case 62:
                $sts[] = 86;
                goto st86;
            case 89:
                $sts[] = 9;
                goto st9;
            case 93:
                $sts[] = 9;
                goto st9;
        }
        gt8:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 10;
                goto st10;
            case 2:
                $sts[] = 10;
                goto st10;
            case 11:
                $sts[] = 10;
                goto st10;
            case 12:
                $sts[] = 10;
                goto st10;
            case 13:
                $sts[] = 10;
                goto st10;
            case 14:
                $sts[] = 10;
                goto st10;
            case 15:
                $sts[] = 10;
                goto st10;
            case 16:
                $sts[] = 10;
                goto st10;
            case 22:
                $sts[] = 10;
                goto st10;
            case 41:
                $sts[] = 10;
                goto st10;
            case 44:
                $sts[] = 10;
                goto st10;
            case 46:
                $sts[] = 10;
                goto st10;
            case 53:
                $sts[] = 10;
                goto st10;
            case 54:
                $sts[] = 10;
                goto st10;
            case 55:
                $sts[] = 73;
                goto st73;
            case 56:
                $sts[] = 10;
                goto st10;
            case 58:
                $sts[] = 10;
                goto st10;
            case 61:
                $sts[] = 10;
                goto st10;
            case 62:
                $sts[] = 84;
                goto st84;
            case 89:
                $sts[] = 10;
                goto st10;
            case 93:
                $sts[] = 10;
                goto st10;
        }
        gt9:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 21;
                goto st21;
            case 2:
                $sts[] = 21;
                goto st21;
            case 11:
                $sts[] = 21;
                goto st21;
            case 12:
                $sts[] = 21;
                goto st21;
            case 13:
                $sts[] = 21;
                goto st21;
            case 14:
                $sts[] = 21;
                goto st21;
            case 15:
                $sts[] = 21;
                goto st21;
            case 16:
                $sts[] = 21;
                goto st21;
            case 22:
                $sts[] = 21;
                goto st21;
            case 41:
                $sts[] = 21;
                goto st21;
            case 44:
                $sts[] = 21;
                goto st21;
            case 46:
                $sts[] = 21;
                goto st21;
            case 53:
                $sts[] = 21;
                goto st21;
            case 54:
                $sts[] = 21;
                goto st21;
            case 55:
                $sts[] = 75;
                goto st75;
            case 56:
                $sts[] = 21;
                goto st21;
            case 58:
                $sts[] = 21;
                goto st21;
            case 61:
                $sts[] = 21;
                goto st21;
            case 62:
                $sts[] = 85;
                goto st85;
            case 89:
                $sts[] = 21;
                goto st21;
            case 93:
                $sts[] = 21;
                goto st21;
        }
        gt10:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 23;
                goto st23;
            case 2:
                $sts[] = 23;
                goto st23;
            case 11:
                $sts[] = 23;
                goto st23;
            case 12:
                $sts[] = 23;
                goto st23;
            case 13:
                $sts[] = 23;
                goto st23;
            case 14:
                $sts[] = 23;
                goto st23;
            case 15:
                $sts[] = 23;
                goto st23;
            case 16:
                $sts[] = 23;
                goto st23;
            case 22:
                $sts[] = 23;
                goto st23;
            case 41:
                $sts[] = 23;
                goto st23;
            case 44:
                $sts[] = 23;
                goto st23;
            case 46:
                $sts[] = 23;
                goto st23;
            case 53:
                $sts[] = 23;
                goto st23;
            case 54:
                $sts[] = 23;
                goto st23;
            case 55:
                $sts[] = 76;
                goto st76;
            case 56:
                $sts[] = 23;
                goto st23;
            case 58:
                $sts[] = 23;
                goto st23;
            case 61:
                $sts[] = 23;
                goto st23;
            case 62:
                $sts[] = 76;
                goto st76;
            case 89:
                $sts[] = 23;
                goto st23;
            case 93:
                $sts[] = 23;
                goto st23;
        }
        gt11:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 24;
                goto st24;
            case 2:
                $sts[] = 24;
                goto st24;
            case 11:
                $sts[] = 24;
                goto st24;
            case 12:
                $sts[] = 24;
                goto st24;
            case 13:
                $sts[] = 24;
                goto st24;
            case 14:
                $sts[] = 24;
                goto st24;
            case 15:
                $sts[] = 24;
                goto st24;
            case 16:
                $sts[] = 24;
                goto st24;
            case 22:
                $sts[] = 24;
                goto st24;
            case 41:
                $sts[] = 24;
                goto st24;
            case 44:
                $sts[] = 24;
                goto st24;
            case 46:
                $sts[] = 24;
                goto st24;
            case 53:
                $sts[] = 24;
                goto st24;
            case 54:
                $sts[] = 24;
                goto st24;
            case 56:
                $sts[] = 24;
                goto st24;
            case 58:
                $sts[] = 24;
                goto st24;
            case 61:
                $sts[] = 24;
                goto st24;
            case 89:
                $sts[] = 24;
                goto st24;
            case 93:
                $sts[] = 24;
                goto st24;
        }
        gt12:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 26;
                goto st26;
            case 2:
                $sts[] = 26;
                goto st26;
            case 11:
                $sts[] = 26;
                goto st26;
            case 12:
                $sts[] = 26;
                goto st26;
            case 13:
                $sts[] = 26;
                goto st26;
            case 14:
                $sts[] = 26;
                goto st26;
            case 15:
                $sts[] = 26;
                goto st26;
            case 16:
                $sts[] = 26;
                goto st26;
            case 22:
                $sts[] = 26;
                goto st26;
            case 41:
                $sts[] = 26;
                goto st26;
            case 44:
                $sts[] = 26;
                goto st26;
            case 46:
                $sts[] = 26;
                goto st26;
            case 53:
                $sts[] = 26;
                goto st26;
            case 54:
                $sts[] = 26;
                goto st26;
            case 55:
                $sts[] = 26;
                goto st26;
            case 56:
                $sts[] = 26;
                goto st26;
            case 58:
                $sts[] = 26;
                goto st26;
            case 61:
                $sts[] = 26;
                goto st26;
            case 62:
                $sts[] = 26;
                goto st26;
            case 89:
                $sts[] = 26;
                goto st26;
            case 93:
                $sts[] = 26;
                goto st26;
        }
        gt13:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 27;
                goto st27;
            case 2:
                $sts[] = 27;
                goto st27;
            case 11:
                $sts[] = 27;
                goto st27;
            case 12:
                $sts[] = 27;
                goto st27;
            case 13:
                $sts[] = 27;
                goto st27;
            case 14:
                $sts[] = 27;
                goto st27;
            case 15:
                $sts[] = 27;
                goto st27;
            case 16:
                $sts[] = 27;
                goto st27;
            case 22:
                $sts[] = 27;
                goto st27;
            case 41:
                $sts[] = 27;
                goto st27;
            case 44:
                $sts[] = 27;
                goto st27;
            case 46:
                $sts[] = 27;
                goto st27;
            case 53:
                $sts[] = 27;
                goto st27;
            case 54:
                $sts[] = 27;
                goto st27;
            case 55:
                $sts[] = 27;
                goto st27;
            case 56:
                $sts[] = 27;
                goto st27;
            case 58:
                $sts[] = 27;
                goto st27;
            case 61:
                $sts[] = 27;
                goto st27;
            case 62:
                $sts[] = 27;
                goto st27;
            case 89:
                $sts[] = 27;
                goto st27;
            case 93:
                $sts[] = 27;
                goto st27;
        }
        gt14:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 28;
                goto st28;
            case 2:
                $sts[] = 28;
                goto st28;
            case 11:
                $sts[] = 28;
                goto st28;
            case 12:
                $sts[] = 28;
                goto st28;
            case 13:
                $sts[] = 28;
                goto st28;
            case 14:
                $sts[] = 28;
                goto st28;
            case 15:
                $sts[] = 28;
                goto st28;
            case 16:
                $sts[] = 28;
                goto st28;
            case 22:
                $sts[] = 28;
                goto st28;
            case 41:
                $sts[] = 28;
                goto st28;
            case 44:
                $sts[] = 28;
                goto st28;
            case 46:
                $sts[] = 28;
                goto st28;
            case 53:
                $sts[] = 28;
                goto st28;
            case 54:
                $sts[] = 28;
                goto st28;
            case 55:
                $sts[] = 28;
                goto st28;
            case 56:
                $sts[] = 28;
                goto st28;
            case 58:
                $sts[] = 28;
                goto st28;
            case 61:
                $sts[] = 28;
                goto st28;
            case 62:
                $sts[] = 28;
                goto st28;
            case 89:
                $sts[] = 28;
                goto st28;
            case 93:
                $sts[] = 28;
                goto st28;
        }
        gt15:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 29;
                goto st29;
            case 2:
                $sts[] = 29;
                goto st29;
            case 11:
                $sts[] = 29;
                goto st29;
            case 12:
                $sts[] = 29;
                goto st29;
            case 13:
                $sts[] = 29;
                goto st29;
            case 14:
                $sts[] = 29;
                goto st29;
            case 15:
                $sts[] = 29;
                goto st29;
            case 16:
                $sts[] = 29;
                goto st29;
            case 22:
                $sts[] = 29;
                goto st29;
            case 41:
                $sts[] = 29;
                goto st29;
            case 44:
                $sts[] = 29;
                goto st29;
            case 46:
                $sts[] = 29;
                goto st29;
            case 53:
                $sts[] = 29;
                goto st29;
            case 54:
                $sts[] = 29;
                goto st29;
            case 55:
                $sts[] = 29;
                goto st29;
            case 56:
                $sts[] = 29;
                goto st29;
            case 58:
                $sts[] = 29;
                goto st29;
            case 61:
                $sts[] = 29;
                goto st29;
            case 62:
                $sts[] = 29;
                goto st29;
            case 89:
                $sts[] = 29;
                goto st29;
            case 93:
                $sts[] = 29;
                goto st29;
        }
        gt16:
        switch ($sts[count($sts) - 1]) {
            case 44:
                $sts[] = 66;
                goto st66;
            case 93:
                $sts[] = 95;
                goto st95;
        }
    }
    protected abstract function arrayPush($p0, $p1);
    protected abstract function arrayOf($p0);
    protected abstract function emptyArray($p0);
    protected abstract function reduceCodeBlockContent($p0);
    protected abstract function reduceExpressionStatement($p0);
    protected abstract function reduceMemberAccessExpression($p0, $p1);
    protected abstract function reduceComputedMemberAccessExpression($p0, $p1);
    protected abstract function reduceVariableAccessExpression($p0);
    protected abstract function reduceNewExpression($p0, $p1 = null);
    protected abstract function reduceConstructedNewExpression($p0);
    protected abstract function reduceFunctionCallExpression($p0, $p1 = null);
    protected abstract function reducePostfixIncrementExpression($p0);
    protected abstract function reducePostfixDecrementExpression($p0);
    protected abstract function reduceNotExpression($p0);
    protected abstract function reduceBitwiseNotExpression($p0);
    protected abstract function reduceUnaryPlusExpression($p0);
    protected abstract function reduceUnaryNegationExpression($p0);
    protected abstract function reducePrefixIncrementExpression($p0);
    protected abstract function reducePrefixDecrementExpression($p0);
    protected abstract function reduceTypeofExpression($p0);
    protected abstract function reduceVoidExpression($p0);
    protected abstract function reduceDeleteExpression($p0);
    protected abstract function reduceAwaitExpression($p0);
    protected abstract function reduceIntegerNumberExpression($p0);
    protected abstract function reduceFloatNumberExpression($p0);
    protected abstract function reduceOctalNumberExpression($p0);
    protected abstract function reduceDoubleQuotedStringExpression($p0);
    protected abstract function reduceSingleQuotedStringExpression($p0);
}