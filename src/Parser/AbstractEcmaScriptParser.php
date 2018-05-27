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
        $this->debugLog('Going to state 0');
        goto st0;
        st0:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 6');
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st6;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 9');
                $sts[] = 9;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 11');
                $sts[] = 11;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 12');
                $sts[] = 12;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 10');
                $sts[] = 10;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 8');
                $sts[] = 8;
                $os[] = array('new ');
                $o += 4;
                goto st8;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('delete ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('typeof ');
                $o += 7;
                goto st15;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('void ');
                $o += 5;
                goto st16;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('await ');
                $o += 6;
                goto st18;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 7');
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st7;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Shifting to state 23');
                $sts[] = 23;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st23;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st19;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NONCODE');
                $this->debugLog('Shifting to state 4');
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st1:
        if ($o === $l) {
            $this->debugLog('Encountered end of string');
            $this->debugLog('Reducing by rule 0 (Start -> CodeBlockContent)');
            $r0 = array_pop($os);
            return $r0;
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect end of string at line ' . $el . ', column ' . $ec);
        st2:
        if ($o === $l) {
            $this->debugLog('Encountered end of string');
            $this->debugLog('Reducing by rule 6 (CodeBlockContent -> CodeBlockItems)');
            $r0 = array_pop($os);
            $os[] = $this->reduceCodeBlockContent($r0);
            array_pop($sts);
            goto gt0;
        }
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 6');
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st6;
            }
            if (substr_compare($string, '}', $o, 1) === 0) {
                $this->debugLog('Encountered CURLY_CLOSE');
                $this->debugLog('Reducing by rule 6 (CodeBlockContent -> CodeBlockItems)');
                $r0 = array_pop($os);
                $os[] = $this->reduceCodeBlockContent($r0);
                array_pop($sts);
                goto gt0;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Shifting to state 25');
                $sts[] = 25;
                $os[] = array(';');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st25;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 9');
                $sts[] = 9;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 11');
                $sts[] = 11;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 12');
                $sts[] = 12;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 10');
                $sts[] = 10;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 8');
                $sts[] = 8;
                $os[] = array('new ');
                $o += 4;
                goto st8;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('delete ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('typeof ');
                $o += 7;
                goto st15;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('void ');
                $o += 5;
                goto st16;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('await ');
                $o += 6;
                goto st18;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 7');
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st7;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Shifting to state 23');
                $sts[] = 23;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st23;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st19;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NONCODE');
                $this->debugLog('Shifting to state 24');
                $sts[] = 24;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st24;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), SEMICOLON (;), PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), end of string or CURLY_CLOSE (}) at line ' . $el . ', column ' . $ec);
        st3:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Shifting to state 27');
                $sts[] = 27;
                $os[] = array(';');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st27;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;) at line ' . $el . ', column ' . $ec);
        st4:
        if ($o === $l) {
            $this->debugLog('Encountered end of string');
            $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
            $r0 = array_pop($os);
            $os[] = $this->emptyArray($r0);
            array_pop($sts);
            goto gt1;
        }
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '}', $o, 1) === 0) {
                $this->debugLog('Encountered CURLY_CLOSE');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NONCODE');
                $this->debugLog('Reducing by rule 5 (CodeBlockItems -> NONCODE)');
                $r0 = array_pop($os);
                $os[] = $this->emptyArray($r0);
                array_pop($sts);
                goto gt1;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), SEMICOLON (;), PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), end of string or CURLY_CLOSE (}) at line ' . $el . ', column ' . $ec);
        st5:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 30');
                $sts[] = 30;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 8 (Statement -> Expression)');
                $r0 = array_pop($os);
                $os[] = $this->reduceExpressionStatement($r0);
                array_pop($sts);
                goto gt2;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 31');
                $sts[] = 31;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 32');
                $sts[] = 32;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or SEMICOLON (;) at line ' . $el . ', column ' . $ec);
        st6:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 6');
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st6;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 9');
                $sts[] = 9;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 11');
                $sts[] = 11;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 12');
                $sts[] = 12;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 10');
                $sts[] = 10;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 8');
                $sts[] = 8;
                $os[] = array('new ');
                $o += 4;
                goto st8;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('delete ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('typeof ');
                $o += 7;
                goto st15;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('void ');
                $o += 5;
                goto st16;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('await ');
                $o += 6;
                goto st18;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 7');
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st7;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Shifting to state 23');
                $sts[] = 23;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st23;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st19;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st7:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 12 (Expression -> IDENTIFIER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 12 (Expression -> IDENTIFIER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 12 (Expression -> IDENTIFIER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 12 (Expression -> IDENTIFIER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 12 (Expression -> IDENTIFIER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 12 (Expression -> IDENTIFIER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 12 (Expression -> IDENTIFIER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 12 (Expression -> IDENTIFIER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 12 (Expression -> IDENTIFIER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st8:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 6');
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st6;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 9');
                $sts[] = 9;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 11');
                $sts[] = 11;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 12');
                $sts[] = 12;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 10');
                $sts[] = 10;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 8');
                $sts[] = 8;
                $os[] = array('new ');
                $o += 4;
                goto st8;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('delete ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('typeof ');
                $o += 7;
                goto st15;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('void ');
                $o += 5;
                goto st16;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('await ');
                $o += 6;
                goto st18;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 7');
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st7;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Shifting to state 23');
                $sts[] = 23;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st23;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st19;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st9:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 6');
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st6;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 9');
                $sts[] = 9;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 11');
                $sts[] = 11;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 12');
                $sts[] = 12;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 10');
                $sts[] = 10;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 8');
                $sts[] = 8;
                $os[] = array('new ');
                $o += 4;
                goto st8;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('delete ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('typeof ');
                $o += 7;
                goto st15;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('void ');
                $o += 5;
                goto st16;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('await ');
                $o += 6;
                goto st18;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 7');
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st7;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Shifting to state 23');
                $sts[] = 23;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st23;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st19;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st10:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 6');
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st6;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 9');
                $sts[] = 9;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 11');
                $sts[] = 11;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 12');
                $sts[] = 12;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 10');
                $sts[] = 10;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 8');
                $sts[] = 8;
                $os[] = array('new ');
                $o += 4;
                goto st8;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('delete ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('typeof ');
                $o += 7;
                goto st15;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('void ');
                $o += 5;
                goto st16;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('await ');
                $o += 6;
                goto st18;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 7');
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st7;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Shifting to state 23');
                $sts[] = 23;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st23;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st19;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st11:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 6');
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st6;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 9');
                $sts[] = 9;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 11');
                $sts[] = 11;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 12');
                $sts[] = 12;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 10');
                $sts[] = 10;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 8');
                $sts[] = 8;
                $os[] = array('new ');
                $o += 4;
                goto st8;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('delete ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('typeof ');
                $o += 7;
                goto st15;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('void ');
                $o += 5;
                goto st16;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('await ');
                $o += 6;
                goto st18;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 7');
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st7;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Shifting to state 23');
                $sts[] = 23;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st23;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st19;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st12:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 6');
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st6;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 9');
                $sts[] = 9;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 11');
                $sts[] = 11;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 12');
                $sts[] = 12;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 10');
                $sts[] = 10;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 8');
                $sts[] = 8;
                $os[] = array('new ');
                $o += 4;
                goto st8;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('delete ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('typeof ');
                $o += 7;
                goto st15;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('void ');
                $o += 5;
                goto st16;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('await ');
                $o += 6;
                goto st18;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 7');
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st7;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Shifting to state 23');
                $sts[] = 23;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st23;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st19;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st13:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 6');
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st6;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 9');
                $sts[] = 9;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 11');
                $sts[] = 11;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 12');
                $sts[] = 12;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 10');
                $sts[] = 10;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 8');
                $sts[] = 8;
                $os[] = array('new ');
                $o += 4;
                goto st8;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('delete ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('typeof ');
                $o += 7;
                goto st15;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('void ');
                $o += 5;
                goto st16;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('await ');
                $o += 6;
                goto st18;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 7');
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st7;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Shifting to state 23');
                $sts[] = 23;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st23;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st19;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st14:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 6');
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st6;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 9');
                $sts[] = 9;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 11');
                $sts[] = 11;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 12');
                $sts[] = 12;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 10');
                $sts[] = 10;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 8');
                $sts[] = 8;
                $os[] = array('new ');
                $o += 4;
                goto st8;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('delete ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('typeof ');
                $o += 7;
                goto st15;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('void ');
                $o += 5;
                goto st16;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('await ');
                $o += 6;
                goto st18;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 7');
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st7;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Shifting to state 23');
                $sts[] = 23;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st23;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st19;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st15:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 6');
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st6;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 9');
                $sts[] = 9;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 11');
                $sts[] = 11;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 12');
                $sts[] = 12;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 10');
                $sts[] = 10;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 8');
                $sts[] = 8;
                $os[] = array('new ');
                $o += 4;
                goto st8;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('delete ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('typeof ');
                $o += 7;
                goto st15;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('void ');
                $o += 5;
                goto st16;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('await ');
                $o += 6;
                goto st18;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 7');
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st7;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Shifting to state 23');
                $sts[] = 23;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st23;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st19;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st16:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 6');
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st6;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 9');
                $sts[] = 9;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 11');
                $sts[] = 11;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 12');
                $sts[] = 12;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 10');
                $sts[] = 10;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 8');
                $sts[] = 8;
                $os[] = array('new ');
                $o += 4;
                goto st8;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('delete ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('typeof ');
                $o += 7;
                goto st15;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('void ');
                $o += 5;
                goto st16;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('await ');
                $o += 6;
                goto st18;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 7');
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st7;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Shifting to state 23');
                $sts[] = 23;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st23;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st19;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st17:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 6');
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st6;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 9');
                $sts[] = 9;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 11');
                $sts[] = 11;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 12');
                $sts[] = 12;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 10');
                $sts[] = 10;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 8');
                $sts[] = 8;
                $os[] = array('new ');
                $o += 4;
                goto st8;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('delete ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('typeof ');
                $o += 7;
                goto st15;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('void ');
                $o += 5;
                goto st16;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('await ');
                $o += 6;
                goto st18;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 7');
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st7;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Shifting to state 23');
                $sts[] = 23;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st23;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st19;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st18:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 6');
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st6;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 9');
                $sts[] = 9;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 11');
                $sts[] = 11;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 12');
                $sts[] = 12;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 10');
                $sts[] = 10;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 8');
                $sts[] = 8;
                $os[] = array('new ');
                $o += 4;
                goto st8;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('delete ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('typeof ');
                $o += 7;
                goto st15;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('void ');
                $o += 5;
                goto st16;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('await ');
                $o += 6;
                goto st18;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 7');
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st7;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Shifting to state 23');
                $sts[] = 23;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st23;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st19;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st19:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 28 (Expression -> NUMBER_INTEGER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 28 (Expression -> NUMBER_INTEGER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 28 (Expression -> NUMBER_INTEGER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 28 (Expression -> NUMBER_INTEGER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 28 (Expression -> NUMBER_INTEGER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 28 (Expression -> NUMBER_INTEGER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 28 (Expression -> NUMBER_INTEGER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 28 (Expression -> NUMBER_INTEGER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 28 (Expression -> NUMBER_INTEGER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st20:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 29 (Expression -> NUMBER_FLOAT)');
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 29 (Expression -> NUMBER_FLOAT)');
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 29 (Expression -> NUMBER_FLOAT)');
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 29 (Expression -> NUMBER_FLOAT)');
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 29 (Expression -> NUMBER_FLOAT)');
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 29 (Expression -> NUMBER_FLOAT)');
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 29 (Expression -> NUMBER_FLOAT)');
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 29 (Expression -> NUMBER_FLOAT)');
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 29 (Expression -> NUMBER_FLOAT)');
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st21:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 30 (Expression -> NUMBER_OCTAL)');
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 30 (Expression -> NUMBER_OCTAL)');
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 30 (Expression -> NUMBER_OCTAL)');
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 30 (Expression -> NUMBER_OCTAL)');
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 30 (Expression -> NUMBER_OCTAL)');
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 30 (Expression -> NUMBER_OCTAL)');
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 30 (Expression -> NUMBER_OCTAL)');
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 30 (Expression -> NUMBER_OCTAL)');
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 30 (Expression -> NUMBER_OCTAL)');
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st22:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 31 (Expression -> STRING_DOUBLEQUOTE)');
                $r0 = array_pop($os);
                $os[] = $this->reduceDoubleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 31 (Expression -> STRING_DOUBLEQUOTE)');
                $r0 = array_pop($os);
                $os[] = $this->reduceDoubleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 31 (Expression -> STRING_DOUBLEQUOTE)');
                $r0 = array_pop($os);
                $os[] = $this->reduceDoubleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 31 (Expression -> STRING_DOUBLEQUOTE)');
                $r0 = array_pop($os);
                $os[] = $this->reduceDoubleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 31 (Expression -> STRING_DOUBLEQUOTE)');
                $r0 = array_pop($os);
                $os[] = $this->reduceDoubleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 31 (Expression -> STRING_DOUBLEQUOTE)');
                $r0 = array_pop($os);
                $os[] = $this->reduceDoubleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 31 (Expression -> STRING_DOUBLEQUOTE)');
                $r0 = array_pop($os);
                $os[] = $this->reduceDoubleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 31 (Expression -> STRING_DOUBLEQUOTE)');
                $r0 = array_pop($os);
                $os[] = $this->reduceDoubleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 31 (Expression -> STRING_DOUBLEQUOTE)');
                $r0 = array_pop($os);
                $os[] = $this->reduceDoubleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st23:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 32 (Expression -> STRING_SINGLEQUOTE)');
                $r0 = array_pop($os);
                $os[] = $this->reduceSingleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 32 (Expression -> STRING_SINGLEQUOTE)');
                $r0 = array_pop($os);
                $os[] = $this->reduceSingleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 32 (Expression -> STRING_SINGLEQUOTE)');
                $r0 = array_pop($os);
                $os[] = $this->reduceSingleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 32 (Expression -> STRING_SINGLEQUOTE)');
                $r0 = array_pop($os);
                $os[] = $this->reduceSingleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 32 (Expression -> STRING_SINGLEQUOTE)');
                $r0 = array_pop($os);
                $os[] = $this->reduceSingleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 32 (Expression -> STRING_SINGLEQUOTE)');
                $r0 = array_pop($os);
                $os[] = $this->reduceSingleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 32 (Expression -> STRING_SINGLEQUOTE)');
                $r0 = array_pop($os);
                $os[] = $this->reduceSingleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 32 (Expression -> STRING_SINGLEQUOTE)');
                $r0 = array_pop($os);
                $os[] = $this->reduceSingleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 32 (Expression -> STRING_SINGLEQUOTE)');
                $r0 = array_pop($os);
                $os[] = $this->reduceSingleQuotedStringExpression($r0);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st24:
        if ($o === $l) {
            $this->debugLog('Encountered end of string');
            $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
            $r1 = array_pop($os);
            $r0 = array_pop($os);
            $os[] = $r0;
            array_pop($sts);
            array_pop($sts);
            goto gt1;
        }
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '}', $o, 1) === 0) {
                $this->debugLog('Encountered CURLY_CLOSE');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NONCODE');
                $this->debugLog('Reducing by rule 1 (CodeBlockItems -> CodeBlockItems NONCODE)');
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), SEMICOLON (;), PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), end of string or CURLY_CLOSE (}) at line ' . $el . ', column ' . $ec);
        st25:
        if ($o === $l) {
            $this->debugLog('Encountered end of string');
            $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
            $r1 = array_pop($os);
            $r0 = array_pop($os);
            $os[] = $r0;
            array_pop($sts);
            array_pop($sts);
            goto gt1;
        }
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '}', $o, 1) === 0) {
                $this->debugLog('Encountered CURLY_CLOSE');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NONCODE');
                $this->debugLog('Reducing by rule 2 (CodeBlockItems -> CodeBlockItems SEMICOLON)');
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), SEMICOLON (;), PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), end of string or CURLY_CLOSE (}) at line ' . $el . ', column ' . $ec);
        st26:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Shifting to state 45');
                $sts[] = 45;
                $os[] = array(';');
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
        throw new \Exception('Expect SEMICOLON (;) at line ' . $el . ', column ' . $ec);
        st27:
        if ($o === $l) {
            $this->debugLog('Encountered end of string');
            $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
            $r1 = array_pop($os);
            $r0 = array_pop($os);
            $os[] = $this->arrayOf($r0);
            array_pop($sts);
            array_pop($sts);
            goto gt1;
        }
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '}', $o, 1) === 0) {
                $this->debugLog('Encountered CURLY_CLOSE');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt1;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NONCODE');
                $this->debugLog('Reducing by rule 4 (CodeBlockItems -> Statement SEMICOLON)');
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), SEMICOLON (;), PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), end of string or CURLY_CLOSE (}) at line ' . $el . ', column ' . $ec);
        st28:
        if ($l > $o) {
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 46');
                $sts[] = 46;
                $os[] = $m;
                $o += strlen($m[0]);
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
        throw new \Exception('Expect IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st29:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 6');
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st6;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 9');
                $sts[] = 9;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 11');
                $sts[] = 11;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 12');
                $sts[] = 12;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 10');
                $sts[] = 10;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 8');
                $sts[] = 8;
                $os[] = array('new ');
                $o += 4;
                goto st8;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('delete ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('typeof ');
                $o += 7;
                goto st15;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('void ');
                $o += 5;
                goto st16;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('await ');
                $o += 6;
                goto st18;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 7');
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st7;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Shifting to state 23');
                $sts[] = 23;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st23;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st19;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st30:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 6');
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st6;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Shifting to state 49');
                $sts[] = 49;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st49;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 9');
                $sts[] = 9;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 11');
                $sts[] = 11;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 12');
                $sts[] = 12;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 10');
                $sts[] = 10;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 8');
                $sts[] = 8;
                $os[] = array('new ');
                $o += 4;
                goto st8;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('delete ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('typeof ');
                $o += 7;
                goto st15;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('void ');
                $o += 5;
                goto st16;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('await ');
                $o += 6;
                goto st18;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 7');
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st7;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Shifting to state 23');
                $sts[] = 23;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st23;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st19;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_CLOSE ()), PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st31:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 16 (Expression -> Expression INCREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 16 (Expression -> Expression INCREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 16 (Expression -> Expression INCREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 16 (Expression -> Expression INCREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 16 (Expression -> Expression INCREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 16 (Expression -> Expression INCREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 16 (Expression -> Expression INCREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 16 (Expression -> Expression INCREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 16 (Expression -> Expression INCREMENT)');
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
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st32:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 17 (Expression -> Expression DECREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 17 (Expression -> Expression DECREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 17 (Expression -> Expression DECREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 17 (Expression -> Expression DECREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 17 (Expression -> Expression DECREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 17 (Expression -> Expression DECREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 17 (Expression -> Expression DECREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 17 (Expression -> Expression DECREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 17 (Expression -> Expression DECREMENT)');
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
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st33:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 30');
                $sts[] = 30;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Shifting to state 51');
                $sts[] = 51;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st51;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 31');
                $sts[] = 31;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 32');
                $sts[] = 32;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), INCREMENT (++) or DECREMENT (--) at line ' . $el . ', column ' . $ec);
        st34:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 30');
                $sts[] = 30;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 13 (Expression -> NEW_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 13 (Expression -> NEW_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 13 (Expression -> NEW_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 13 (Expression -> NEW_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 13 (Expression -> NEW_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 13 (Expression -> NEW_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st35:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 30');
                $sts[] = 30;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 18 (Expression -> NOT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 18 (Expression -> NOT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 18 (Expression -> NOT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 18 (Expression -> NOT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 31');
                $sts[] = 31;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 32');
                $sts[] = 32;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st36:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 30');
                $sts[] = 30;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 19 (Expression -> TILDE Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceBitwiseNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 19 (Expression -> TILDE Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceBitwiseNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 19 (Expression -> TILDE Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceBitwiseNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 19 (Expression -> TILDE Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceBitwiseNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 31');
                $sts[] = 31;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 32');
                $sts[] = 32;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st37:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 30');
                $sts[] = 30;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 20 (Expression -> UNARY_PLUS Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryPlusExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 20 (Expression -> UNARY_PLUS Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryPlusExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 20 (Expression -> UNARY_PLUS Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryPlusExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 20 (Expression -> UNARY_PLUS Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryPlusExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 31');
                $sts[] = 31;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 32');
                $sts[] = 32;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st38:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 30');
                $sts[] = 30;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 21 (Expression -> UNARY_NEGATION Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryNegationExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 21 (Expression -> UNARY_NEGATION Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryNegationExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 21 (Expression -> UNARY_NEGATION Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryNegationExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 21 (Expression -> UNARY_NEGATION Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryNegationExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 31');
                $sts[] = 31;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 32');
                $sts[] = 32;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st39:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 30');
                $sts[] = 30;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 22 (Expression -> PREFIX_INCREMENT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixIncrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 22 (Expression -> PREFIX_INCREMENT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixIncrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 22 (Expression -> PREFIX_INCREMENT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixIncrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 22 (Expression -> PREFIX_INCREMENT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixIncrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 31');
                $sts[] = 31;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 32');
                $sts[] = 32;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st40:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 30');
                $sts[] = 30;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 23 (Expression -> PREFIX_DECREMENT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixDecrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 23 (Expression -> PREFIX_DECREMENT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixDecrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 23 (Expression -> PREFIX_DECREMENT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixDecrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 23 (Expression -> PREFIX_DECREMENT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixDecrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 31');
                $sts[] = 31;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 32');
                $sts[] = 32;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st41:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 30');
                $sts[] = 30;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 24 (Expression -> TYPEOF_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceTypeofExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 24 (Expression -> TYPEOF_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceTypeofExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 24 (Expression -> TYPEOF_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceTypeofExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 24 (Expression -> TYPEOF_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceTypeofExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 31');
                $sts[] = 31;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 32');
                $sts[] = 32;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st42:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 30');
                $sts[] = 30;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 25 (Expression -> VOID_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceVoidExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 25 (Expression -> VOID_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceVoidExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 25 (Expression -> VOID_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceVoidExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 25 (Expression -> VOID_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceVoidExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 31');
                $sts[] = 31;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 32');
                $sts[] = 32;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st43:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 30');
                $sts[] = 30;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 26 (Expression -> DELETE_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceDeleteExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 26 (Expression -> DELETE_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceDeleteExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 26 (Expression -> DELETE_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceDeleteExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 26 (Expression -> DELETE_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceDeleteExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 31');
                $sts[] = 31;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 32');
                $sts[] = 32;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st44:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 30');
                $sts[] = 30;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 27 (Expression -> AWAIT_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceAwaitExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 27 (Expression -> AWAIT_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceAwaitExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 27 (Expression -> AWAIT_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceAwaitExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 27 (Expression -> AWAIT_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceAwaitExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 31');
                $sts[] = 31;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 32');
                $sts[] = 32;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st45:
        if ($o === $l) {
            $this->debugLog('Encountered end of string');
            $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered CURLY_CLOSE');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered NOT');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
                $this->debugLog('Encountered NONCODE');
                $this->debugLog('Reducing by rule 3 (CodeBlockItems -> CodeBlockItems Statement SEMICOLON)');
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), SEMICOLON (;), PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*"), STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\'), end of string or CURLY_CLOSE (}) at line ' . $el . ', column ' . $ec);
        st46:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 10 (Expression -> Expression DOT IDENTIFIER)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 10 (Expression -> Expression DOT IDENTIFIER)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 10 (Expression -> Expression DOT IDENTIFIER)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 10 (Expression -> Expression DOT IDENTIFIER)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 10 (Expression -> Expression DOT IDENTIFIER)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 10 (Expression -> Expression DOT IDENTIFIER)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 10 (Expression -> Expression DOT IDENTIFIER)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 10 (Expression -> Expression DOT IDENTIFIER)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 10 (Expression -> Expression DOT IDENTIFIER)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st47:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 30');
                $sts[] = 30;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Shifting to state 52');
                $sts[] = 52;
                $os[] = array(']');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st52;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 31');
                $sts[] = 31;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 32');
                $sts[] = 32;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect BLOCK_CLOSE (]), DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), INCREMENT (++) or DECREMENT (--) at line ' . $el . ', column ' . $ec);
        st48:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Shifting to state 53');
                $sts[] = 53;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st53;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Shifting to state 54');
                $sts[] = 54;
                $os[] = array(',');
                $o += 1;
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
        throw new \Exception('Expect PAREN_CLOSE ()) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st49:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 15 (Expression -> Expression PAREN_OPEN PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 15 (Expression -> Expression PAREN_OPEN PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 15 (Expression -> Expression PAREN_OPEN PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 15 (Expression -> Expression PAREN_OPEN PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 15 (Expression -> Expression PAREN_OPEN PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 15 (Expression -> Expression PAREN_OPEN PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 15 (Expression -> Expression PAREN_OPEN PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 15 (Expression -> Expression PAREN_OPEN PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 15 (Expression -> Expression PAREN_OPEN PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st50:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 30');
                $sts[] = 30;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 34 (ArgumentList -> Expression)');
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 34 (ArgumentList -> Expression)');
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 31');
                $sts[] = 31;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 32');
                $sts[] = 32;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--), PAREN_CLOSE ()) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st51:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 9 (Expression -> PAREN_OPEN Expression PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceParenExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 9 (Expression -> PAREN_OPEN Expression PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceParenExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 9 (Expression -> PAREN_OPEN Expression PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceParenExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 9 (Expression -> PAREN_OPEN Expression PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceParenExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 9 (Expression -> PAREN_OPEN Expression PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceParenExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 9 (Expression -> PAREN_OPEN Expression PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceParenExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 9 (Expression -> PAREN_OPEN Expression PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceParenExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 9 (Expression -> PAREN_OPEN Expression PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceParenExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 9 (Expression -> PAREN_OPEN Expression PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceParenExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st52:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 11 (Expression -> Expression BLOCK_OPEN Expression BLOCK_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 11 (Expression -> Expression BLOCK_OPEN Expression BLOCK_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 11 (Expression -> Expression BLOCK_OPEN Expression BLOCK_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 11 (Expression -> Expression BLOCK_OPEN Expression BLOCK_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 11 (Expression -> Expression BLOCK_OPEN Expression BLOCK_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 11 (Expression -> Expression BLOCK_OPEN Expression BLOCK_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 11 (Expression -> Expression BLOCK_OPEN Expression BLOCK_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 11 (Expression -> Expression BLOCK_OPEN Expression BLOCK_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 11 (Expression -> Expression BLOCK_OPEN Expression BLOCK_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st53:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 14 (Expression -> Expression PAREN_OPEN ArgumentList PAREN_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 14 (Expression -> Expression PAREN_OPEN ArgumentList PAREN_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 14 (Expression -> Expression PAREN_OPEN ArgumentList PAREN_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 14 (Expression -> Expression PAREN_OPEN ArgumentList PAREN_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 14 (Expression -> Expression PAREN_OPEN ArgumentList PAREN_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 14 (Expression -> Expression PAREN_OPEN ArgumentList PAREN_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 14 (Expression -> Expression PAREN_OPEN ArgumentList PAREN_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 14 (Expression -> Expression PAREN_OPEN ArgumentList PAREN_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 14 (Expression -> Expression PAREN_OPEN ArgumentList PAREN_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st54:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 6');
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st6;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 9');
                $sts[] = 9;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 11');
                $sts[] = 11;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 12');
                $sts[] = 12;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st12;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 10');
                $sts[] = 10;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 8');
                $sts[] = 8;
                $os[] = array('new ');
                $o += 4;
                goto st8;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('delete ');
                $o += 7;
                goto st17;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('typeof ');
                $o += 7;
                goto st15;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('void ');
                $o += 5;
                goto st16;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('await ');
                $o += 6;
                goto st18;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 7');
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st7;
            }
            if (preg_match('("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*")ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_DOUBLEQUOTE');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
            }
            if (preg_match('(\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\')ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered STRING_SINGLEQUOTE');
                $this->debugLog('Shifting to state 23');
                $sts[] = 23;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st23;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_OCTAL');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st21;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st19;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect PAREN_OPEN ((), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NEW_ (newspace), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), STRING_DOUBLEQUOTE ("([^\\\\"]+|\\\\\\\\|\\\\"|\\\\[^"])*") or STRING_SINGLEQUOTE (\'([^\\\\\']+|\\\\\\\\|\\\\\'|\\\\[^\'])*\') at line ' . $el . ', column ' . $ec);
        st55:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 30');
                $sts[] = 30;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 33 (ArgumentList -> ArgumentList COMMA Expression)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 33 (ArgumentList -> ArgumentList COMMA Expression)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 31');
                $sts[] = 31;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st31;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 32');
                $sts[] = 32;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = array('.');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--), PAREN_CLOSE ()) or COMMA (,) at line ' . $el . ', column ' . $ec);
        gt0:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 1;
                $this->debugLog('Going to state 1');
                goto st1;
        }
        gt1:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 2;
                $this->debugLog('Going to state 2');
                goto st2;
        }
        gt2:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 3;
                $this->debugLog('Going to state 3');
                goto st3;
            case 2:
                $sts[] = 26;
                $this->debugLog('Going to state 26');
                goto st26;
        }
        gt3:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 5;
                $this->debugLog('Going to state 5');
                goto st5;
            case 2:
                $sts[] = 5;
                $this->debugLog('Going to state 5');
                goto st5;
            case 6:
                $sts[] = 33;
                $this->debugLog('Going to state 33');
                goto st33;
            case 8:
                $sts[] = 34;
                $this->debugLog('Going to state 34');
                goto st34;
            case 9:
                $sts[] = 35;
                $this->debugLog('Going to state 35');
                goto st35;
            case 10:
                $sts[] = 36;
                $this->debugLog('Going to state 36');
                goto st36;
            case 11:
                $sts[] = 37;
                $this->debugLog('Going to state 37');
                goto st37;
            case 12:
                $sts[] = 38;
                $this->debugLog('Going to state 38');
                goto st38;
            case 13:
                $sts[] = 39;
                $this->debugLog('Going to state 39');
                goto st39;
            case 14:
                $sts[] = 40;
                $this->debugLog('Going to state 40');
                goto st40;
            case 15:
                $sts[] = 41;
                $this->debugLog('Going to state 41');
                goto st41;
            case 16:
                $sts[] = 42;
                $this->debugLog('Going to state 42');
                goto st42;
            case 17:
                $sts[] = 43;
                $this->debugLog('Going to state 43');
                goto st43;
            case 18:
                $sts[] = 44;
                $this->debugLog('Going to state 44');
                goto st44;
            case 29:
                $sts[] = 47;
                $this->debugLog('Going to state 47');
                goto st47;
            case 30:
                $sts[] = 50;
                $this->debugLog('Going to state 50');
                goto st50;
            case 54:
                $sts[] = 55;
                $this->debugLog('Going to state 55');
                goto st55;
        }
        gt4:
        switch ($sts[count($sts) - 1]) {
            case 30:
                $sts[] = 48;
                $this->debugLog('Going to state 48');
                goto st48;
        }
    }
    protected abstract function arrayPush($p0, $p1);
    protected abstract function arrayOf($p0);
    protected abstract function emptyArray($p0);
    protected abstract function reduceCodeBlockContent($p0);
    protected abstract function reduceExpressionStatement($p0);
    protected abstract function reduceParenExpression($p0);
    protected abstract function reduceMemberAccessExpression($p0, $p1);
    protected abstract function reduceComputedMemberAccessExpression($p0, $p1);
    protected abstract function reduceVariableAccessExpression($p0);
    protected abstract function reduceNewExpression($p0);
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
    protected function debugLog($message)
    {
    }
}