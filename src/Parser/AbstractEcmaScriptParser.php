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
                $sts[] = 28;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 10;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 14;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 27;
                $os[] = array('new');
                $o += 3;
                goto st27;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 18;
                $os[] = array('delete');
                $o += 6;
                goto st18;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 16;
                $os[] = array('typeof');
                $o += 6;
                goto st16;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 17;
                $os[] = array('void');
                $o += 4;
                goto st17;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 19;
                $os[] = array('await');
                $o += 5;
                goto st19;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
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
                $sts[] = 28;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (substr_compare($string, '}', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceCodeBlockContent($r0);
                array_pop($sts);
                goto gt0;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $sts[] = 31;
                $os[] = array(';');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 10;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 14;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 27;
                $os[] = array('new');
                $o += 3;
                goto st27;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 18;
                $os[] = array('delete');
                $o += 6;
                goto st18;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 16;
                $os[] = array('typeof');
                $o += 6;
                goto st16;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 17;
                $os[] = array('void');
                $o += 4;
                goto st17;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 19;
                $os[] = array('await');
                $o += 5;
                goto st19;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, (, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), end of string or } at line ' . $el . ', column ' . $ec);
        st3:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $sts[] = 33;
                $os[] = array(';');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), (, end of string or } at line ' . $el . ', column ' . $ec);
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
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 34;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 36;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st36;
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
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 35;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect (, ., [, ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st7:
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
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
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
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st9:
        if ($l > $o) {
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 37;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 38;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st38;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ++ or -- at line ' . $el . ', column ' . $ec);
        st10:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 28;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 10;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 14;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 27;
                $os[] = array('new');
                $o += 3;
                goto st27;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 18;
                $os[] = array('delete');
                $o += 6;
                goto st18;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 16;
                $os[] = array('typeof');
                $o += 6;
                goto st16;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 17;
                $os[] = array('void');
                $o += 4;
                goto st17;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 19;
                $os[] = array('await');
                $o += 5;
                goto st19;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st11:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 28;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 10;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 14;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 27;
                $os[] = array('new');
                $o += 3;
                goto st27;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 18;
                $os[] = array('delete');
                $o += 6;
                goto st18;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 16;
                $os[] = array('typeof');
                $o += 6;
                goto st16;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 17;
                $os[] = array('void');
                $o += 4;
                goto st17;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 19;
                $os[] = array('await');
                $o += 5;
                goto st19;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st12:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 28;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 10;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 14;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 27;
                $os[] = array('new');
                $o += 3;
                goto st27;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 18;
                $os[] = array('delete');
                $o += 6;
                goto st18;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 16;
                $os[] = array('typeof');
                $o += 6;
                goto st16;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 17;
                $os[] = array('void');
                $o += 4;
                goto st17;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 19;
                $os[] = array('await');
                $o += 5;
                goto st19;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st13:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 28;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 10;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 14;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 27;
                $os[] = array('new');
                $o += 3;
                goto st27;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 18;
                $os[] = array('delete');
                $o += 6;
                goto st18;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 16;
                $os[] = array('typeof');
                $o += 6;
                goto st16;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 17;
                $os[] = array('void');
                $o += 4;
                goto st17;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 19;
                $os[] = array('await');
                $o += 5;
                goto st19;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st14:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 28;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 10;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 14;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 27;
                $os[] = array('new');
                $o += 3;
                goto st27;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 18;
                $os[] = array('delete');
                $o += 6;
                goto st18;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 16;
                $os[] = array('typeof');
                $o += 6;
                goto st16;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 17;
                $os[] = array('void');
                $o += 4;
                goto st17;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 19;
                $os[] = array('await');
                $o += 5;
                goto st19;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st15:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 28;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 10;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 14;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 27;
                $os[] = array('new');
                $o += 3;
                goto st27;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 18;
                $os[] = array('delete');
                $o += 6;
                goto st18;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 16;
                $os[] = array('typeof');
                $o += 6;
                goto st16;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 17;
                $os[] = array('void');
                $o += 4;
                goto st17;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 19;
                $os[] = array('await');
                $o += 5;
                goto st19;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st16:
        if ($l > $o) {
            if (($ml = strspn($string, '
	 ', $o)) > 0) {
                $sts[] = 45;
                $os[] = array(substr($string, $o, $ml));
                $o += $ml;
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
        throw new \Exception('Expect  at line ' . $el . ', column ' . $ec);
        st17:
        if ($l > $o) {
            if (($ml = strspn($string, '
	 ', $o)) > 0) {
                $sts[] = 46;
                $os[] = array(substr($string, $o, $ml));
                $o += $ml;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st46;
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
                $sts[] = 47;
                $os[] = array(substr($string, $o, $ml));
                $o += $ml;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st47;
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
                $sts[] = 48;
                $os[] = array(substr($string, $o, $ml));
                $o += $ml;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st48;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect  at line ' . $el . ', column ' . $ec);
        st20:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st21:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st22:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st23:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
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
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ., [, (, ), ] or , at line ' . $el . ', column ' . $ec);
        st24:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
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
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ., [, (, ), ], ,, ++ or -- at line ' . $el . ', column ' . $ec);
        st25:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
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
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ., [, (, ), ], ,, ++ or -- at line ' . $el . ', column ' . $ec);
        st26:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
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
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ., [, (, ), ], ,, ++ or -- at line ' . $el . ', column ' . $ec);
        st27:
        if ($l > $o) {
            if (($ml = strspn($string, '
	 ', $o)) > 0) {
                $sts[] = 49;
                $os[] = array(substr($string, $o, $ml));
                $o += $ml;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st49;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect  at line ' . $el . ', column ' . $ec);
        st28:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 28;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 10;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 14;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 27;
                $os[] = array('new');
                $o += 3;
                goto st27;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 18;
                $os[] = array('delete');
                $o += 6;
                goto st18;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 16;
                $os[] = array('typeof');
                $o += 6;
                goto st16;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 17;
                $os[] = array('void');
                $o += 4;
                goto st17;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 19;
                $os[] = array('await');
                $o += 5;
                goto st19;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st29:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt11;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ., [, (, ), ], ,, ++ or -- at line ' . $el . ', column ' . $ec);
        st30:
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), (, end of string or } at line ' . $el . ', column ' . $ec);
        st31:
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), (, end of string or } at line ' . $el . ', column ' . $ec);
        st32:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $sts[] = 51;
                $os[] = array(';');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st51;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ; at line ' . $el . ', column ' . $ec);
        st33:
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), (, end of string or } at line ' . $el . ', column ' . $ec);
        st34:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 28;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $sts[] = 53;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st53;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 10;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 14;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 27;
                $os[] = array('new');
                $o += 3;
                goto st27;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 18;
                $os[] = array('delete');
                $o += 6;
                goto st18;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 16;
                $os[] = array('typeof');
                $o += 6;
                goto st16;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 17;
                $os[] = array('void');
                $o += 4;
                goto st17;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 19;
                $os[] = array('await');
                $o += 5;
                goto st19;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ), !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st35:
        if ($l > $o) {
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 55;
                $os[] = $m;
                $o += strlen($m[0]);
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
        throw new \Exception('Expect IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st36:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 28;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 10;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 14;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 27;
                $os[] = array('new');
                $o += 3;
                goto st27;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 18;
                $os[] = array('delete');
                $o += 6;
                goto st18;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 16;
                $os[] = array('typeof');
                $o += 6;
                goto st16;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 17;
                $os[] = array('void');
                $o += 4;
                goto st17;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 19;
                $os[] = array('await');
                $o += 5;
                goto st19;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st37:
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
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st38:
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
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st39:
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
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st40:
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
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st41:
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
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st42:
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
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st43:
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
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st44:
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
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st45:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 28;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 10;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 14;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 27;
                $os[] = array('new');
                $o += 3;
                goto st27;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 18;
                $os[] = array('delete');
                $o += 6;
                goto st18;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 16;
                $os[] = array('typeof');
                $o += 6;
                goto st16;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 17;
                $os[] = array('void');
                $o += 4;
                goto st17;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 19;
                $os[] = array('await');
                $o += 5;
                goto st19;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st46:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 28;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 10;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 14;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 27;
                $os[] = array('new');
                $o += 3;
                goto st27;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 18;
                $os[] = array('delete');
                $o += 6;
                goto st18;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 16;
                $os[] = array('typeof');
                $o += 6;
                goto st16;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 17;
                $os[] = array('void');
                $o += 4;
                goto st17;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 19;
                $os[] = array('await');
                $o += 5;
                goto st19;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st47:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 28;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 10;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 14;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 27;
                $os[] = array('new');
                $o += 3;
                goto st27;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 18;
                $os[] = array('delete');
                $o += 6;
                goto st18;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 16;
                $os[] = array('typeof');
                $o += 6;
                goto st16;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 17;
                $os[] = array('void');
                $o += 4;
                goto st17;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 19;
                $os[] = array('await');
                $o += 5;
                goto st19;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st48:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 28;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 10;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 14;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 27;
                $os[] = array('new');
                $o += 3;
                goto st27;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 18;
                $os[] = array('delete');
                $o += 6;
                goto st18;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 16;
                $os[] = array('typeof');
                $o += 6;
                goto st16;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 17;
                $os[] = array('void');
                $o += 4;
                goto st17;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 19;
                $os[] = array('await');
                $o += 5;
                goto st19;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st49:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 28;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 27;
                $os[] = array('new');
                $o += 3;
                goto st27;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st50:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $sts[] = 66;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st66;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ) at line ' . $el . ', column ' . $ec);
        st51:
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), (, end of string or } at line ' . $el . ', column ' . $ec);
        st52:
        if ($l > $o) {
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
            if (substr_compare($string, ',', $o, 1) === 0) {
                $sts[] = 68;
                $os[] = array(',');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st68;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ) or , at line ' . $el . ', column ' . $ec);
        st53:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt6;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st54:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                goto gt12;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ) or , at line ' . $el . ', column ' . $ec);
        st55:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ., [, (, ), ], ,, ++ or -- at line ' . $el . ', column ' . $ec);
        st56:
        if ($l > $o) {
            if (substr_compare($string, ']', $o, 1) === 0) {
                $sts[] = 69;
                $os[] = array(']');
                $o += 1;
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
        throw new \Exception('Expect ] at line ' . $el . ', column ' . $ec);
        st57:
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
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st58:
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
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st59:
        if ($l > $o) {
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
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st60:
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
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st61:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 70;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st70;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 36;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st36;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 35;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect (, ., [, ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st62:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st63:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
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
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ., [, (, ), ] or , at line ' . $el . ', column ' . $ec);
        st64:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
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
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ., [, (, ), ] or , at line ' . $el . ', column ' . $ec);
        st65:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
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
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ., [, (, ), ] or , at line ' . $el . ', column ' . $ec);
        st66:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ., [, (, ), ] or , at line ' . $el . ', column ' . $ec);
        st67:
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
                goto gt6;
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
                goto gt6;
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
                goto gt6;
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
                goto gt6;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st68:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 28;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 10;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 14;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 27;
                $os[] = array('new');
                $o += 3;
                goto st27;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 18;
                $os[] = array('delete');
                $o += 6;
                goto st18;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 16;
                $os[] = array('typeof');
                $o += 6;
                goto st16;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 17;
                $os[] = array('void');
                $o += 4;
                goto st17;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 19;
                $os[] = array('await');
                $o += 5;
                goto st19;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st69:
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
                goto gt10;
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
                goto gt10;
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
                goto gt10;
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
                goto gt10;
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
                goto gt10;
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
                goto gt10;
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
                goto gt10;
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
                goto gt10;
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
                goto gt10;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ., [, (, ), ], ,, ++ or -- at line ' . $el . ', column ' . $ec);
        st70:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 28;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $sts[] = 73;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st73;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $sts[] = 10;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 14;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 15;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $sts[] = 13;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $sts[] = 11;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 27;
                $os[] = array('new');
                $o += 3;
                goto st27;
            }
            if (substr_compare($string, 'delete', $o, 6) === 0) {
                $sts[] = 18;
                $os[] = array('delete');
                $o += 6;
                goto st18;
            }
            if (substr_compare($string, 'typeof', $o, 6) === 0) {
                $sts[] = 16;
                $os[] = array('typeof');
                $o += 6;
                goto st16;
            }
            if (substr_compare($string, 'void', $o, 4) === 0) {
                $sts[] = 17;
                $os[] = array('void');
                $o += 4;
                goto st17;
            }
            if (substr_compare($string, 'await', $o, 5) === 0) {
                $sts[] = 19;
                $os[] = array('await');
                $o += 5;
                goto st19;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ), !, ~, +, -, ++, --, typeof, void, delete, await, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st71:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ) or , at line ' . $el . ', column ' . $ec);
        st72:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $sts[] = 74;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st74;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $sts[] = 68;
                $os[] = array(',');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st68;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ) or , at line ' . $el . ', column ' . $ec);
        st73:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st74:
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
                goto gt5;
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
                goto gt5;
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
                goto gt5;
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
                goto gt5;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ), ] or , at line ' . $el . ', column ' . $ec);
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
                $sts[] = 32;
                goto st32;
        }
        gt3:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 5;
                goto st5;
            case 2:
                $sts[] = 5;
                goto st5;
            case 10:
                $sts[] = 39;
                goto st39;
            case 11:
                $sts[] = 40;
                goto st40;
            case 12:
                $sts[] = 41;
                goto st41;
            case 13:
                $sts[] = 42;
                goto st42;
            case 14:
                $sts[] = 43;
                goto st43;
            case 15:
                $sts[] = 44;
                goto st44;
            case 28:
                $sts[] = 50;
                goto st50;
            case 34:
                $sts[] = 54;
                goto st54;
            case 36:
                $sts[] = 56;
                goto st56;
            case 45:
                $sts[] = 57;
                goto st57;
            case 46:
                $sts[] = 58;
                goto st58;
            case 47:
                $sts[] = 59;
                goto st59;
            case 48:
                $sts[] = 60;
                goto st60;
            case 68:
                $sts[] = 71;
                goto st71;
            case 70:
                $sts[] = 54;
                goto st54;
        }
        gt4:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 6;
                goto st6;
            case 2:
                $sts[] = 6;
                goto st6;
            case 10:
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
            case 28:
                $sts[] = 6;
                goto st6;
            case 34:
                $sts[] = 6;
                goto st6;
            case 36:
                $sts[] = 6;
                goto st6;
            case 45:
                $sts[] = 6;
                goto st6;
            case 46:
                $sts[] = 6;
                goto st6;
            case 47:
                $sts[] = 6;
                goto st6;
            case 48:
                $sts[] = 6;
                goto st6;
            case 49:
                $sts[] = 61;
                goto st61;
            case 68:
                $sts[] = 6;
                goto st6;
            case 70:
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
            case 10:
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
            case 28:
                $sts[] = 7;
                goto st7;
            case 34:
                $sts[] = 7;
                goto st7;
            case 36:
                $sts[] = 7;
                goto st7;
            case 45:
                $sts[] = 7;
                goto st7;
            case 46:
                $sts[] = 7;
                goto st7;
            case 47:
                $sts[] = 7;
                goto st7;
            case 48:
                $sts[] = 7;
                goto st7;
            case 49:
                $sts[] = 62;
                goto st62;
            case 68:
                $sts[] = 7;
                goto st7;
            case 70:
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
            case 10:
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
            case 28:
                $sts[] = 8;
                goto st8;
            case 34:
                $sts[] = 8;
                goto st8;
            case 36:
                $sts[] = 8;
                goto st8;
            case 45:
                $sts[] = 8;
                goto st8;
            case 46:
                $sts[] = 8;
                goto st8;
            case 47:
                $sts[] = 8;
                goto st8;
            case 48:
                $sts[] = 8;
                goto st8;
            case 68:
                $sts[] = 8;
                goto st8;
            case 70:
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
            case 10:
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
            case 28:
                $sts[] = 9;
                goto st9;
            case 34:
                $sts[] = 9;
                goto st9;
            case 36:
                $sts[] = 9;
                goto st9;
            case 45:
                $sts[] = 9;
                goto st9;
            case 46:
                $sts[] = 9;
                goto st9;
            case 47:
                $sts[] = 9;
                goto st9;
            case 48:
                $sts[] = 9;
                goto st9;
            case 68:
                $sts[] = 9;
                goto st9;
            case 70:
                $sts[] = 9;
                goto st9;
        }
        gt8:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 23;
                goto st23;
            case 2:
                $sts[] = 23;
                goto st23;
            case 10:
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
            case 28:
                $sts[] = 23;
                goto st23;
            case 34:
                $sts[] = 23;
                goto st23;
            case 36:
                $sts[] = 23;
                goto st23;
            case 45:
                $sts[] = 23;
                goto st23;
            case 46:
                $sts[] = 23;
                goto st23;
            case 47:
                $sts[] = 23;
                goto st23;
            case 48:
                $sts[] = 23;
                goto st23;
            case 49:
                $sts[] = 23;
                goto st23;
            case 68:
                $sts[] = 23;
                goto st23;
            case 70:
                $sts[] = 23;
                goto st23;
        }
        gt9:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 24;
                goto st24;
            case 2:
                $sts[] = 24;
                goto st24;
            case 10:
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
            case 28:
                $sts[] = 24;
                goto st24;
            case 34:
                $sts[] = 24;
                goto st24;
            case 36:
                $sts[] = 24;
                goto st24;
            case 45:
                $sts[] = 24;
                goto st24;
            case 46:
                $sts[] = 24;
                goto st24;
            case 47:
                $sts[] = 24;
                goto st24;
            case 48:
                $sts[] = 24;
                goto st24;
            case 49:
                $sts[] = 63;
                goto st63;
            case 68:
                $sts[] = 24;
                goto st24;
            case 70:
                $sts[] = 24;
                goto st24;
        }
        gt10:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 25;
                goto st25;
            case 2:
                $sts[] = 25;
                goto st25;
            case 10:
                $sts[] = 25;
                goto st25;
            case 11:
                $sts[] = 25;
                goto st25;
            case 12:
                $sts[] = 25;
                goto st25;
            case 13:
                $sts[] = 25;
                goto st25;
            case 14:
                $sts[] = 25;
                goto st25;
            case 15:
                $sts[] = 25;
                goto st25;
            case 28:
                $sts[] = 25;
                goto st25;
            case 34:
                $sts[] = 25;
                goto st25;
            case 36:
                $sts[] = 25;
                goto st25;
            case 45:
                $sts[] = 25;
                goto st25;
            case 46:
                $sts[] = 25;
                goto st25;
            case 47:
                $sts[] = 25;
                goto st25;
            case 48:
                $sts[] = 25;
                goto st25;
            case 49:
                $sts[] = 64;
                goto st64;
            case 68:
                $sts[] = 25;
                goto st25;
            case 70:
                $sts[] = 25;
                goto st25;
        }
        gt11:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 26;
                goto st26;
            case 2:
                $sts[] = 26;
                goto st26;
            case 10:
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
            case 28:
                $sts[] = 26;
                goto st26;
            case 34:
                $sts[] = 26;
                goto st26;
            case 36:
                $sts[] = 26;
                goto st26;
            case 45:
                $sts[] = 26;
                goto st26;
            case 46:
                $sts[] = 26;
                goto st26;
            case 47:
                $sts[] = 26;
                goto st26;
            case 48:
                $sts[] = 26;
                goto st26;
            case 49:
                $sts[] = 65;
                goto st65;
            case 68:
                $sts[] = 26;
                goto st26;
            case 70:
                $sts[] = 26;
                goto st26;
        }
        gt12:
        switch ($sts[count($sts) - 1]) {
            case 34:
                $sts[] = 52;
                goto st52;
            case 70:
                $sts[] = 72;
                goto st72;
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
}