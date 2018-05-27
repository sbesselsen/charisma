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
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
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
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
            }
            if (substr_compare($string, '}', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceCodeBlockContent($r0);
                array_pop($sts);
                goto gt0;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $sts[] = 36;
                $os[] = array(';');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st36;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 30;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), SEMICOLON (;), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), end of string or CURLY_CLOSE (}) at line ' . $el . ', column ' . $ec);
        st3:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $sts[] = 38;
                $os[] = array(';');
                $o += 1;
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
        throw new \Exception('Expect SEMICOLON (;) at line ' . $el . ', column ' . $ec);
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), SEMICOLON (;), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), end of string or CURLY_CLOSE (}) at line ' . $el . ', column ' . $ec);
        st5:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
            }
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
        throw new \Exception('Expect PAREN_OPEN (() or SEMICOLON (;) at line ' . $el . ', column ' . $ec);
        st6:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 43;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st43;
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
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 40;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st40;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 41;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st41;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 42;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st42;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect INCREMENT (++), DECREMENT (--), DOT (.), BLOCK_OPEN ([), SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st7:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 45;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st45;
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
                $sts[] = 44;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st44;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st8:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 47;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st47;
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
                $sts[] = 46;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st9:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
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
        throw new \Exception('Expect SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st10:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
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
        throw new \Exception('Expect SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st11:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st12:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st13:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st14:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st15:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st16:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st17:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st18:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st19:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
        st20:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st21:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
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
                goto gt4;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
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
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), SEMICOLON (;), BLOCK_CLOSE (]), INCREMENT (++), DECREMENT (--), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st22:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
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
                goto gt4;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
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
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), SEMICOLON (;), BLOCK_CLOSE (]), INCREMENT (++), DECREMENT (--), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st23:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt4;
            }
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
                goto gt4;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
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
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), SEMICOLON (;), BLOCK_CLOSE (]), INCREMENT (++), DECREMENT (--), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st24:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st25:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st26:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt8;
            }
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
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st27:
        if ($l > $o) {
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 62;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st62;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 61;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st61;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.) or BLOCK_OPEN ([) at line ' . $el . ', column ' . $ec);
        st28:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt11;
            }
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
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), SEMICOLON (;), BLOCK_CLOSE (]), INCREMENT (++), DECREMENT (--), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st29:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt12;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st30:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt12;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st31:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt12;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st32:
        if ($l > $o) {
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt13;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt13;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.) or BLOCK_OPEN ([) at line ' . $el . ', column ' . $ec);
        st33:
        if ($l > $o) {
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceDoubleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt14;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceDoubleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt14;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.) or BLOCK_OPEN ([) at line ' . $el . ', column ' . $ec);
        st34:
        if ($l > $o) {
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceSingleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt14;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceSingleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt14;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.) or BLOCK_OPEN ([) at line ' . $el . ', column ' . $ec);
        st35:
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), SEMICOLON (;), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), end of string or CURLY_CLOSE (}) at line ' . $el . ', column ' . $ec);
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), SEMICOLON (;), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), end of string or CURLY_CLOSE (}) at line ' . $el . ', column ' . $ec);
        st37:
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
        throw new \Exception('Expect SEMICOLON (;) at line ' . $el . ', column ' . $ec);
        st38:
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), SEMICOLON (;), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), end of string or CURLY_CLOSE (}) at line ' . $el . ', column ' . $ec);
        st39:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $sts[] = 65;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st65;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect PAREN_CLOSE ()), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st40:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
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
        throw new \Exception('Expect SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st41:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
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
        throw new \Exception('Expect SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st42:
        if ($l > $o) {
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 67;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st67;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st43:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st44:
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
        st45:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st46:
        if ($l > $o) {
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 71;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st71;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st47:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st48:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
            }
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
        throw new \Exception('Expect PAREN_OPEN ((), SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st49:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceBitwiseNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
            }
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
        throw new \Exception('Expect PAREN_OPEN ((), SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st50:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryPlusExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
            }
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
        throw new \Exception('Expect PAREN_OPEN ((), SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st51:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryNegationExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
            }
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
        throw new \Exception('Expect PAREN_OPEN ((), SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st52:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixIncrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
            }
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
        throw new \Exception('Expect PAREN_OPEN ((), SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st53:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixDecrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
            }
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
        throw new \Exception('Expect PAREN_OPEN ((), SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st54:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceTypeofExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceTypeofExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceTypeofExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceTypeofExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceTypeofExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st55:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceVoidExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceVoidExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceVoidExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceVoidExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceVoidExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st56:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 43;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st43;
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
            if (substr_compare($string, '++', $o, 2) === 0) {
                $sts[] = 40;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st40;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $sts[] = 41;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st41;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 42;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st42;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), INCREMENT (++), DECREMENT (--), SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st57:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
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
        throw new \Exception('Expect PAREN_OPEN (() at line ' . $el . ', column ' . $ec);
        st58:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceAwaitExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceAwaitExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceAwaitExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceAwaitExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceAwaitExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st59:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
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
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_CLOSE ()) or PAREN_OPEN (() at line ' . $el . ', column ' . $ec);
        st60:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 74;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st74;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PRIO_PAREN_OPEN ((), PAREN_OPEN ((), SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st61:
        if ($l > $o) {
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 75;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st75;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st62:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), SEMICOLON (;), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), end of string or CURLY_CLOSE (}) at line ' . $el . ', column ' . $ec);
        st64:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $sts[] = 77;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st77;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $sts[] = 78;
                $os[] = array(',');
                $o += 1;
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
        throw new \Exception('Expect PAREN_CLOSE ()) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st65:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st66:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                goto gt15;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                goto gt15;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), PAREN_CLOSE ()) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st67:
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
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), SEMICOLON (;), BLOCK_CLOSE (]), INCREMENT (++), DECREMENT (--), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st68:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $sts[] = 79;
                $os[] = array(']');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st79;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect BLOCK_CLOSE (]) or PAREN_OPEN (() at line ' . $el . ', column ' . $ec);
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
                goto gt9;
            }
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
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), SEMICOLON (;), BLOCK_CLOSE (]), INCREMENT (++), DECREMENT (--), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st70:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $sts[] = 80;
                $os[] = array(']');
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
        throw new \Exception('Expect BLOCK_CLOSE (]) or PAREN_OPEN (() at line ' . $el . ', column ' . $ec);
        st71:
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
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), SEMICOLON (;), BLOCK_CLOSE (]), INCREMENT (++), DECREMENT (--), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st72:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $sts[] = 81;
                $os[] = array(']');
                $o += 1;
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
        throw new \Exception('Expect BLOCK_CLOSE (]) or PAREN_OPEN (() at line ' . $el . ', column ' . $ec);
        st73:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt6;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st74:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $sts[] = 83;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st83;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect PAREN_CLOSE ()), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st75:
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
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), SEMICOLON (;), BLOCK_CLOSE (]), INCREMENT (++), DECREMENT (--), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st76:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $sts[] = 84;
                $os[] = array(']');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st84;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect BLOCK_CLOSE (]) or PAREN_OPEN (() at line ' . $el . ', column ' . $ec);
        st77:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
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
                goto gt5;
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
                goto gt5;
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
                goto gt5;
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
                goto gt5;
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
                goto gt5;
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
                goto gt5;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st78:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 24;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
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
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $sts[] = 19;
                $os[] = array('delete ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $sts[] = 17;
                $os[] = array('typeof ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $sts[] = 18;
                $os[] = array('void ');
                $o += 5;
                goto st18;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $sts[] = 20;
                $os[] = array('await ');
                $o += 6;
                goto st20;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $sts[] = 33;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st33;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $sts[] = 34;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 31;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), PAREN_OPEN ((), NEW_ (newspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st79:
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
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), SEMICOLON (;), BLOCK_CLOSE (]), INCREMENT (++), DECREMENT (--), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st80:
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
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), SEMICOLON (;), BLOCK_CLOSE (]), INCREMENT (++), DECREMENT (--), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st81:
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
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), SEMICOLON (;), BLOCK_CLOSE (]), INCREMENT (++), DECREMENT (--), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st82:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $sts[] = 86;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st86;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $sts[] = 78;
                $os[] = array(',');
                $o += 1;
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
        throw new \Exception('Expect PAREN_CLOSE ()) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st83:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
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
        throw new \Exception('Expect SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st84:
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
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), SEMICOLON (;), BLOCK_CLOSE (]), INCREMENT (++), DECREMENT (--), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
        st85:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 39;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st39;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt15;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt15;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), PAREN_CLOSE ()) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st86:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1, $r3);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1, $r3);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1, $r3);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1, $r3);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1, $r3);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1, $r3);
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
        throw new \Exception('Expect SEMICOLON (;), BLOCK_CLOSE (]), PAREN_CLOSE ()), PRIO_PAREN_OPEN ((), PAREN_OPEN (() or COMMA (,) at line ' . $el . ', column ' . $ec);
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
                $sts[] = 37;
                goto st37;
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
                $sts[] = 48;
                goto st48;
            case 12:
                $sts[] = 49;
                goto st49;
            case 13:
                $sts[] = 50;
                goto st50;
            case 14:
                $sts[] = 51;
                goto st51;
            case 15:
                $sts[] = 52;
                goto st52;
            case 16:
                $sts[] = 53;
                goto st53;
            case 17:
                $sts[] = 54;
                goto st54;
            case 18:
                $sts[] = 55;
                goto st55;
            case 19:
                $sts[] = 57;
                goto st57;
            case 20:
                $sts[] = 58;
                goto st58;
            case 24:
                $sts[] = 59;
                goto st59;
            case 25:
                $sts[] = 60;
                goto st60;
            case 39:
                $sts[] = 66;
                goto st66;
            case 43:
                $sts[] = 68;
                goto st68;
            case 45:
                $sts[] = 70;
                goto st70;
            case 47:
                $sts[] = 72;
                goto st72;
            case 62:
                $sts[] = 76;
                goto st76;
            case 74:
                $sts[] = 66;
                goto st66;
            case 78:
                $sts[] = 85;
                goto st85;
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
            case 17:
                $sts[] = 6;
                goto st6;
            case 18:
                $sts[] = 6;
                goto st6;
            case 19:
                $sts[] = 56;
                goto st56;
            case 20:
                $sts[] = 6;
                goto st6;
            case 24:
                $sts[] = 6;
                goto st6;
            case 25:
                $sts[] = 6;
                goto st6;
            case 39:
                $sts[] = 6;
                goto st6;
            case 43:
                $sts[] = 6;
                goto st6;
            case 45:
                $sts[] = 6;
                goto st6;
            case 47:
                $sts[] = 6;
                goto st6;
            case 62:
                $sts[] = 6;
                goto st6;
            case 74:
                $sts[] = 6;
                goto st6;
            case 78:
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
            case 17:
                $sts[] = 7;
                goto st7;
            case 18:
                $sts[] = 7;
                goto st7;
            case 19:
                $sts[] = 7;
                goto st7;
            case 20:
                $sts[] = 7;
                goto st7;
            case 24:
                $sts[] = 7;
                goto st7;
            case 25:
                $sts[] = 7;
                goto st7;
            case 39:
                $sts[] = 7;
                goto st7;
            case 43:
                $sts[] = 7;
                goto st7;
            case 45:
                $sts[] = 7;
                goto st7;
            case 47:
                $sts[] = 7;
                goto st7;
            case 62:
                $sts[] = 7;
                goto st7;
            case 74:
                $sts[] = 7;
                goto st7;
            case 78:
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
            case 17:
                $sts[] = 8;
                goto st8;
            case 18:
                $sts[] = 8;
                goto st8;
            case 19:
                $sts[] = 8;
                goto st8;
            case 20:
                $sts[] = 8;
                goto st8;
            case 24:
                $sts[] = 8;
                goto st8;
            case 25:
                $sts[] = 8;
                goto st8;
            case 39:
                $sts[] = 8;
                goto st8;
            case 43:
                $sts[] = 8;
                goto st8;
            case 45:
                $sts[] = 8;
                goto st8;
            case 47:
                $sts[] = 8;
                goto st8;
            case 62:
                $sts[] = 8;
                goto st8;
            case 74:
                $sts[] = 8;
                goto st8;
            case 78:
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
            case 17:
                $sts[] = 9;
                goto st9;
            case 18:
                $sts[] = 9;
                goto st9;
            case 19:
                $sts[] = 9;
                goto st9;
            case 20:
                $sts[] = 9;
                goto st9;
            case 24:
                $sts[] = 9;
                goto st9;
            case 25:
                $sts[] = 9;
                goto st9;
            case 39:
                $sts[] = 9;
                goto st9;
            case 43:
                $sts[] = 9;
                goto st9;
            case 45:
                $sts[] = 9;
                goto st9;
            case 47:
                $sts[] = 9;
                goto st9;
            case 62:
                $sts[] = 9;
                goto st9;
            case 74:
                $sts[] = 9;
                goto st9;
            case 78:
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
            case 17:
                $sts[] = 10;
                goto st10;
            case 18:
                $sts[] = 10;
                goto st10;
            case 19:
                $sts[] = 10;
                goto st10;
            case 20:
                $sts[] = 10;
                goto st10;
            case 24:
                $sts[] = 10;
                goto st10;
            case 25:
                $sts[] = 10;
                goto st10;
            case 39:
                $sts[] = 10;
                goto st10;
            case 43:
                $sts[] = 10;
                goto st10;
            case 45:
                $sts[] = 10;
                goto st10;
            case 47:
                $sts[] = 10;
                goto st10;
            case 62:
                $sts[] = 10;
                goto st10;
            case 74:
                $sts[] = 10;
                goto st10;
            case 78:
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
            case 17:
                $sts[] = 21;
                goto st21;
            case 18:
                $sts[] = 21;
                goto st21;
            case 19:
                $sts[] = 21;
                goto st21;
            case 20:
                $sts[] = 21;
                goto st21;
            case 24:
                $sts[] = 21;
                goto st21;
            case 25:
                $sts[] = 21;
                goto st21;
            case 39:
                $sts[] = 21;
                goto st21;
            case 43:
                $sts[] = 21;
                goto st21;
            case 45:
                $sts[] = 21;
                goto st21;
            case 47:
                $sts[] = 21;
                goto st21;
            case 62:
                $sts[] = 21;
                goto st21;
            case 74:
                $sts[] = 21;
                goto st21;
            case 78:
                $sts[] = 21;
                goto st21;
        }
        gt10:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 22;
                goto st22;
            case 2:
                $sts[] = 22;
                goto st22;
            case 11:
                $sts[] = 22;
                goto st22;
            case 12:
                $sts[] = 22;
                goto st22;
            case 13:
                $sts[] = 22;
                goto st22;
            case 14:
                $sts[] = 22;
                goto st22;
            case 15:
                $sts[] = 22;
                goto st22;
            case 16:
                $sts[] = 22;
                goto st22;
            case 17:
                $sts[] = 22;
                goto st22;
            case 18:
                $sts[] = 22;
                goto st22;
            case 19:
                $sts[] = 22;
                goto st22;
            case 20:
                $sts[] = 22;
                goto st22;
            case 24:
                $sts[] = 22;
                goto st22;
            case 25:
                $sts[] = 22;
                goto st22;
            case 39:
                $sts[] = 22;
                goto st22;
            case 43:
                $sts[] = 22;
                goto st22;
            case 45:
                $sts[] = 22;
                goto st22;
            case 47:
                $sts[] = 22;
                goto st22;
            case 62:
                $sts[] = 22;
                goto st22;
            case 74:
                $sts[] = 22;
                goto st22;
            case 78:
                $sts[] = 22;
                goto st22;
        }
        gt11:
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
            case 17:
                $sts[] = 23;
                goto st23;
            case 18:
                $sts[] = 23;
                goto st23;
            case 19:
                $sts[] = 23;
                goto st23;
            case 20:
                $sts[] = 23;
                goto st23;
            case 24:
                $sts[] = 23;
                goto st23;
            case 25:
                $sts[] = 23;
                goto st23;
            case 39:
                $sts[] = 23;
                goto st23;
            case 43:
                $sts[] = 23;
                goto st23;
            case 45:
                $sts[] = 23;
                goto st23;
            case 47:
                $sts[] = 23;
                goto st23;
            case 62:
                $sts[] = 23;
                goto st23;
            case 74:
                $sts[] = 23;
                goto st23;
            case 78:
                $sts[] = 23;
                goto st23;
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
            case 17:
                $sts[] = 26;
                goto st26;
            case 18:
                $sts[] = 26;
                goto st26;
            case 19:
                $sts[] = 26;
                goto st26;
            case 20:
                $sts[] = 26;
                goto st26;
            case 24:
                $sts[] = 26;
                goto st26;
            case 25:
                $sts[] = 26;
                goto st26;
            case 39:
                $sts[] = 26;
                goto st26;
            case 43:
                $sts[] = 26;
                goto st26;
            case 45:
                $sts[] = 26;
                goto st26;
            case 47:
                $sts[] = 26;
                goto st26;
            case 62:
                $sts[] = 26;
                goto st26;
            case 74:
                $sts[] = 26;
                goto st26;
            case 78:
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
            case 17:
                $sts[] = 27;
                goto st27;
            case 18:
                $sts[] = 27;
                goto st27;
            case 19:
                $sts[] = 27;
                goto st27;
            case 20:
                $sts[] = 27;
                goto st27;
            case 24:
                $sts[] = 27;
                goto st27;
            case 25:
                $sts[] = 27;
                goto st27;
            case 39:
                $sts[] = 27;
                goto st27;
            case 43:
                $sts[] = 27;
                goto st27;
            case 45:
                $sts[] = 27;
                goto st27;
            case 47:
                $sts[] = 27;
                goto st27;
            case 62:
                $sts[] = 27;
                goto st27;
            case 74:
                $sts[] = 27;
                goto st27;
            case 78:
                $sts[] = 27;
                goto st27;
        }
        gt14:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 32;
                goto st32;
            case 2:
                $sts[] = 32;
                goto st32;
            case 11:
                $sts[] = 32;
                goto st32;
            case 12:
                $sts[] = 32;
                goto st32;
            case 13:
                $sts[] = 32;
                goto st32;
            case 14:
                $sts[] = 32;
                goto st32;
            case 15:
                $sts[] = 32;
                goto st32;
            case 16:
                $sts[] = 32;
                goto st32;
            case 17:
                $sts[] = 32;
                goto st32;
            case 18:
                $sts[] = 32;
                goto st32;
            case 19:
                $sts[] = 32;
                goto st32;
            case 20:
                $sts[] = 32;
                goto st32;
            case 24:
                $sts[] = 32;
                goto st32;
            case 25:
                $sts[] = 32;
                goto st32;
            case 39:
                $sts[] = 32;
                goto st32;
            case 43:
                $sts[] = 32;
                goto st32;
            case 45:
                $sts[] = 32;
                goto st32;
            case 47:
                $sts[] = 32;
                goto st32;
            case 62:
                $sts[] = 32;
                goto st32;
            case 74:
                $sts[] = 32;
                goto st32;
            case 78:
                $sts[] = 32;
                goto st32;
        }
        gt15:
        switch ($sts[count($sts) - 1]) {
            case 39:
                $sts[] = 64;
                goto st64;
            case 74:
                $sts[] = 82;
                goto st82;
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
    protected abstract function reduceDoubleQuotedStringExpression($p0);
    protected abstract function reduceSingleQuotedStringExpression($p0);
}