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
                $this->debugLog('Shifting to state 24');
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
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 25');
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = array('delete ');
                $o += 7;
                goto st21;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = array('typeof ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = array('void ');
                $o += 5;
                goto st20;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = array('await ');
                $o += 6;
                goto st22;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
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
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 27');
                $sts[] = 27;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st27;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
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
                $this->debugLog('Shifting to state 24');
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
                $this->debugLog('Encountered CURLY_CLOSE');
                $this->debugLog('Reducing by rule 6 (CodeBlockContent -> CodeBlockItems)');
                $r0 = array_pop($os);
                $os[] = $this->reduceCodeBlockContent($r0);
                array_pop($sts);
                goto gt0;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Shifting to state 31');
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
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 25');
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = array('delete ');
                $o += 7;
                goto st21;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = array('typeof ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = array('void ');
                $o += 5;
                goto st20;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = array('await ');
                $o += 6;
                goto st22;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
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
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 27');
                $sts[] = 27;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st27;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st28;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NONCODE');
                $this->debugLog('Shifting to state 30');
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), SEMICOLON (;), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), end of string or CURLY_CLOSE (}) at line ' . $el . ', column ' . $ec);
        st3:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Shifting to state 33');
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), SEMICOLON (;), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), end of string or CURLY_CLOSE (}) at line ' . $el . ', column ' . $ec);
        st5:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 38');
                $sts[] = 38;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st38;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 37');
                $sts[] = 37;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
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
                $this->debugLog('Shifting to state 34');
                $sts[] = 34;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 35');
                $sts[] = 35;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 36');
                $sts[] = 36;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect INCREMENT (++), DECREMENT (--), DOT (.), BLOCK_OPEN ([), PAREN_OPEN (() or SEMICOLON (;) at line ' . $el . ', column ' . $ec);
        st6:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 9 (Expression -> MemberAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 9 (Expression -> MemberAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 9 (Expression -> MemberAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 9 (Expression -> MemberAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 9 (Expression -> MemberAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 9 (Expression -> MemberAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 9 (Expression -> MemberAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 9 (Expression -> MemberAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 9 (Expression -> MemberAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st7:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 10 (Expression -> ComputedMemberAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 10 (Expression -> ComputedMemberAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 10 (Expression -> ComputedMemberAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 10 (Expression -> ComputedMemberAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 10 (Expression -> ComputedMemberAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 10 (Expression -> ComputedMemberAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 10 (Expression -> ComputedMemberAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 10 (Expression -> ComputedMemberAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 10 (Expression -> ComputedMemberAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
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
                $this->debugLog('Reducing by rule 11 (Expression -> VariableAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 11 (Expression -> VariableAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 11 (Expression -> VariableAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 11 (Expression -> VariableAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 11 (Expression -> VariableAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 11 (Expression -> VariableAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 11 (Expression -> VariableAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 11 (Expression -> VariableAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 11 (Expression -> VariableAccessExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st9:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 12 (Expression -> FunctionCallExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 12 (Expression -> FunctionCallExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 12 (Expression -> FunctionCallExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 12 (Expression -> FunctionCallExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 12 (Expression -> FunctionCallExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 12 (Expression -> FunctionCallExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 12 (Expression -> FunctionCallExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 12 (Expression -> FunctionCallExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 12 (Expression -> FunctionCallExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st10:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 13 (Expression -> ParenExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 13 (Expression -> ParenExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 13 (Expression -> ParenExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 13 (Expression -> ParenExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 13 (Expression -> ParenExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 13 (Expression -> ParenExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 13 (Expression -> ParenExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 13 (Expression -> ParenExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 13 (Expression -> ParenExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st11:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 14 (Expression -> NewExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 14 (Expression -> NewExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 14 (Expression -> NewExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 14 (Expression -> NewExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 14 (Expression -> NewExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 14 (Expression -> NewExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 14 (Expression -> NewExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 14 (Expression -> NewExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 14 (Expression -> NewExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st12:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 15 (Expression -> ValueExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 15 (Expression -> ValueExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 15 (Expression -> ValueExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 15 (Expression -> ValueExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 15 (Expression -> ValueExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 15 (Expression -> ValueExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 15 (Expression -> ValueExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 15 (Expression -> ValueExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 15 (Expression -> ValueExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st13:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 24');
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
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 25');
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = array('delete ');
                $o += 7;
                goto st21;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = array('typeof ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = array('void ');
                $o += 5;
                goto st20;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = array('await ');
                $o += 6;
                goto st22;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
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
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 27');
                $sts[] = 27;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st27;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
        st14:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 24');
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
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 25');
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = array('delete ');
                $o += 7;
                goto st21;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = array('typeof ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = array('void ');
                $o += 5;
                goto st20;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = array('await ');
                $o += 6;
                goto st22;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
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
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 27');
                $sts[] = 27;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st27;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
        st15:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 24');
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
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 25');
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = array('delete ');
                $o += 7;
                goto st21;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = array('typeof ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = array('void ');
                $o += 5;
                goto st20;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = array('await ');
                $o += 6;
                goto st22;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
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
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 27');
                $sts[] = 27;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st27;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
        st16:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 24');
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
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 25');
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = array('delete ');
                $o += 7;
                goto st21;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = array('typeof ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = array('void ');
                $o += 5;
                goto st20;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = array('await ');
                $o += 6;
                goto st22;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
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
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 27');
                $sts[] = 27;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st27;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
        st17:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 24');
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
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 25');
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = array('delete ');
                $o += 7;
                goto st21;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = array('typeof ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = array('void ');
                $o += 5;
                goto st20;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = array('await ');
                $o += 6;
                goto st22;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
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
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 27');
                $sts[] = 27;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st27;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
        st18:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 24');
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
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 25');
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = array('delete ');
                $o += 7;
                goto st21;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = array('typeof ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = array('void ');
                $o += 5;
                goto st20;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = array('await ');
                $o += 6;
                goto st22;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
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
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 27');
                $sts[] = 27;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st27;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
        st19:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 24');
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
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 25');
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = array('delete ');
                $o += 7;
                goto st21;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = array('typeof ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = array('void ');
                $o += 5;
                goto st20;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = array('await ');
                $o += 6;
                goto st22;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
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
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 27');
                $sts[] = 27;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st27;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
        st20:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 24');
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
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 25');
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = array('delete ');
                $o += 7;
                goto st21;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = array('typeof ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = array('void ');
                $o += 5;
                goto st20;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = array('await ');
                $o += 6;
                goto st22;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
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
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 27');
                $sts[] = 27;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st27;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
        st21:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 24');
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
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 25');
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = array('delete ');
                $o += 7;
                goto st21;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = array('typeof ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = array('void ');
                $o += 5;
                goto st20;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = array('await ');
                $o += 6;
                goto st22;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
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
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 27');
                $sts[] = 27;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st27;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
        st22:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 24');
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
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 25');
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = array('delete ');
                $o += 7;
                goto st21;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = array('typeof ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = array('void ');
                $o += 5;
                goto st20;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = array('await ');
                $o += 6;
                goto st22;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
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
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 27');
                $sts[] = 27;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st27;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
        st23:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 19 (VariableAccessExpression -> IDENTIFIER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 19 (VariableAccessExpression -> IDENTIFIER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 19 (VariableAccessExpression -> IDENTIFIER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 19 (VariableAccessExpression -> IDENTIFIER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 19 (VariableAccessExpression -> IDENTIFIER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 19 (VariableAccessExpression -> IDENTIFIER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 19 (VariableAccessExpression -> IDENTIFIER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 19 (VariableAccessExpression -> IDENTIFIER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt6;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 19 (VariableAccessExpression -> IDENTIFIER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt6;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st24:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 24');
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
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 25');
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = array('delete ');
                $o += 7;
                goto st21;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = array('typeof ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = array('void ');
                $o += 5;
                goto st20;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = array('await ');
                $o += 6;
                goto st22;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
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
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 27');
                $sts[] = 27;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st27;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
        st25:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 24');
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
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 25');
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = array('delete ');
                $o += 7;
                goto st21;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = array('typeof ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = array('void ');
                $o += 5;
                goto st20;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = array('await ');
                $o += 6;
                goto st22;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
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
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 27');
                $sts[] = 27;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st27;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
        st26:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 35 (ValueExpression -> NumberExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 35 (ValueExpression -> NumberExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 35 (ValueExpression -> NumberExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 35 (ValueExpression -> NumberExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 35 (ValueExpression -> NumberExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 35 (ValueExpression -> NumberExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 35 (ValueExpression -> NumberExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 35 (ValueExpression -> NumberExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 35 (ValueExpression -> NumberExpression)');
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt10;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st27:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 36 (NumberExpression -> NUMBER_INTEGER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 36 (NumberExpression -> NUMBER_INTEGER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 36 (NumberExpression -> NUMBER_INTEGER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 36 (NumberExpression -> NUMBER_INTEGER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 36 (NumberExpression -> NUMBER_INTEGER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 36 (NumberExpression -> NUMBER_INTEGER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 36 (NumberExpression -> NUMBER_INTEGER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 36 (NumberExpression -> NUMBER_INTEGER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 36 (NumberExpression -> NUMBER_INTEGER)');
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st28:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 37 (NumberExpression -> NUMBER_FLOAT)');
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 37 (NumberExpression -> NUMBER_FLOAT)');
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 37 (NumberExpression -> NUMBER_FLOAT)');
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 37 (NumberExpression -> NUMBER_FLOAT)');
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 37 (NumberExpression -> NUMBER_FLOAT)');
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 37 (NumberExpression -> NUMBER_FLOAT)');
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 37 (NumberExpression -> NUMBER_FLOAT)');
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 37 (NumberExpression -> NUMBER_FLOAT)');
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 37 (NumberExpression -> NUMBER_FLOAT)');
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st29:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 38 (NumberExpression -> NUMBER_OCTAL)');
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 38 (NumberExpression -> NUMBER_OCTAL)');
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 38 (NumberExpression -> NUMBER_OCTAL)');
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 38 (NumberExpression -> NUMBER_OCTAL)');
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 38 (NumberExpression -> NUMBER_OCTAL)');
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 38 (NumberExpression -> NUMBER_OCTAL)');
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 38 (NumberExpression -> NUMBER_OCTAL)');
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 38 (NumberExpression -> NUMBER_OCTAL)');
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 38 (NumberExpression -> NUMBER_OCTAL)');
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt11;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st30:
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), SEMICOLON (;), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), end of string or CURLY_CLOSE (}) at line ' . $el . ', column ' . $ec);
        st31:
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), SEMICOLON (;), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), end of string or CURLY_CLOSE (}) at line ' . $el . ', column ' . $ec);
        st32:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Shifting to state 51');
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
        throw new \Exception('Expect SEMICOLON (;) at line ' . $el . ', column ' . $ec);
        st33:
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), SEMICOLON (;), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), end of string or CURLY_CLOSE (}) at line ' . $el . ', column ' . $ec);
        st34:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 23 (Expression -> Expression INCREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 23 (Expression -> Expression INCREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 23 (Expression -> Expression INCREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 23 (Expression -> Expression INCREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 23 (Expression -> Expression INCREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 23 (Expression -> Expression INCREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 23 (Expression -> Expression INCREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 23 (Expression -> Expression INCREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixIncrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 23 (Expression -> Expression INCREMENT)');
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
        st35:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 24 (Expression -> Expression DECREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 24 (Expression -> Expression DECREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 24 (Expression -> Expression DECREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 24 (Expression -> Expression DECREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 24 (Expression -> Expression DECREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 24 (Expression -> Expression DECREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 24 (Expression -> Expression DECREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 24 (Expression -> Expression DECREMENT)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePostfixDecrementExpression($r0);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 24 (Expression -> Expression DECREMENT)');
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
        st36:
        if ($l > $o) {
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
                $this->debugLog('Shifting to state 52');
                $sts[] = 52;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st52;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st37:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 24');
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
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 25');
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = array('delete ');
                $o += 7;
                goto st21;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = array('typeof ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = array('void ');
                $o += 5;
                goto st20;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = array('await ');
                $o += 6;
                goto st22;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
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
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 27');
                $sts[] = 27;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st27;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
        st38:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 24');
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
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Shifting to state 55');
                $sts[] = 55;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st55;
            }
            if (substr_compare($string, '!', $o, 1) === 0) {
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 25');
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = array('delete ');
                $o += 7;
                goto st21;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = array('typeof ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = array('void ');
                $o += 5;
                goto st20;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = array('await ');
                $o += 6;
                goto st22;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
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
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 27');
                $sts[] = 27;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st27;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
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
        throw new \Exception('Expect PAREN_CLOSE ()), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
        st39:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 38');
                $sts[] = 38;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st38;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 25 (Expression -> NOT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 37');
                $sts[] = 37;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 25 (Expression -> NOT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 25 (Expression -> NOT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 25 (Expression -> NOT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 34');
                $sts[] = 34;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 35');
                $sts[] = 35;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 36');
                $sts[] = 36;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect INCREMENT (++), DECREMENT (--), DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st40:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 38');
                $sts[] = 38;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st38;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 26 (Expression -> TILDE Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceBitwiseNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 37');
                $sts[] = 37;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 26 (Expression -> TILDE Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceBitwiseNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 26 (Expression -> TILDE Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceBitwiseNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 26 (Expression -> TILDE Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceBitwiseNotExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 34');
                $sts[] = 34;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 35');
                $sts[] = 35;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 36');
                $sts[] = 36;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect INCREMENT (++), DECREMENT (--), DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st41:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 38');
                $sts[] = 38;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st38;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 27 (Expression -> UNARY_PLUS Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryPlusExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 37');
                $sts[] = 37;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 27 (Expression -> UNARY_PLUS Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryPlusExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 27 (Expression -> UNARY_PLUS Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryPlusExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 27 (Expression -> UNARY_PLUS Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryPlusExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 34');
                $sts[] = 34;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 35');
                $sts[] = 35;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 36');
                $sts[] = 36;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect INCREMENT (++), DECREMENT (--), DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st42:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 38');
                $sts[] = 38;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st38;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 28 (Expression -> UNARY_NEGATION Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryNegationExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 37');
                $sts[] = 37;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 28 (Expression -> UNARY_NEGATION Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryNegationExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 28 (Expression -> UNARY_NEGATION Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryNegationExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 28 (Expression -> UNARY_NEGATION Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceUnaryNegationExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 34');
                $sts[] = 34;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 35');
                $sts[] = 35;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 36');
                $sts[] = 36;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect INCREMENT (++), DECREMENT (--), DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st43:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 38');
                $sts[] = 38;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st38;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 29 (Expression -> PREFIX_INCREMENT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixIncrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 37');
                $sts[] = 37;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 29 (Expression -> PREFIX_INCREMENT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixIncrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 29 (Expression -> PREFIX_INCREMENT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixIncrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 29 (Expression -> PREFIX_INCREMENT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixIncrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 34');
                $sts[] = 34;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 35');
                $sts[] = 35;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 36');
                $sts[] = 36;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect INCREMENT (++), DECREMENT (--), DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st44:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 38');
                $sts[] = 38;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st38;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 30 (Expression -> PREFIX_DECREMENT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixDecrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 37');
                $sts[] = 37;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 30 (Expression -> PREFIX_DECREMENT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixDecrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 30 (Expression -> PREFIX_DECREMENT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixDecrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 30 (Expression -> PREFIX_DECREMENT Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reducePrefixDecrementExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 34');
                $sts[] = 34;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 35');
                $sts[] = 35;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 36');
                $sts[] = 36;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect INCREMENT (++), DECREMENT (--), DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st45:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 38');
                $sts[] = 38;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st38;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 31 (Expression -> TYPEOF_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceTypeofExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 37');
                $sts[] = 37;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 31 (Expression -> TYPEOF_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceTypeofExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 31 (Expression -> TYPEOF_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceTypeofExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 31 (Expression -> TYPEOF_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceTypeofExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 34');
                $sts[] = 34;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 35');
                $sts[] = 35;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 36');
                $sts[] = 36;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect INCREMENT (++), DECREMENT (--), DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st46:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 38');
                $sts[] = 38;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st38;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 32 (Expression -> VOID_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceVoidExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 37');
                $sts[] = 37;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 32 (Expression -> VOID_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceVoidExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 32 (Expression -> VOID_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceVoidExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 32 (Expression -> VOID_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceVoidExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 34');
                $sts[] = 34;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 35');
                $sts[] = 35;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 36');
                $sts[] = 36;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect INCREMENT (++), DECREMENT (--), DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st47:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 38');
                $sts[] = 38;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st38;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 33 (Expression -> DELETE_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceDeleteExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 37');
                $sts[] = 37;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 33 (Expression -> DELETE_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceDeleteExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 33 (Expression -> DELETE_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceDeleteExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 33 (Expression -> DELETE_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceDeleteExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 34');
                $sts[] = 34;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 35');
                $sts[] = 35;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 36');
                $sts[] = 36;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect INCREMENT (++), DECREMENT (--), DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st48:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 38');
                $sts[] = 38;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st38;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 34 (Expression -> AWAIT_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceAwaitExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 37');
                $sts[] = 37;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 34 (Expression -> AWAIT_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceAwaitExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 34 (Expression -> AWAIT_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceAwaitExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 34 (Expression -> AWAIT_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceAwaitExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 34');
                $sts[] = 34;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 35');
                $sts[] = 35;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 36');
                $sts[] = 36;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect INCREMENT (++), DECREMENT (--), DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st49:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 38');
                $sts[] = 38;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st38;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Shifting to state 57');
                $sts[] = 57;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st57;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 37');
                $sts[] = 37;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 34');
                $sts[] = 34;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 35');
                $sts[] = 35;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 36');
                $sts[] = 36;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect PAREN_CLOSE ()), INCREMENT (++), DECREMENT (--), DOT (.), BLOCK_OPEN ([) or PAREN_OPEN (() at line ' . $el . ', column ' . $ec);
        st50:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 38');
                $sts[] = 38;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st38;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 20 (NewExpression -> NEW_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 37');
                $sts[] = 37;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 20 (NewExpression -> NEW_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 20 (NewExpression -> NEW_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 20 (NewExpression -> NEW_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 20 (NewExpression -> NEW_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 20 (NewExpression -> NEW_ Expression)');
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceNewExpression($r1);
                array_pop($sts);
                array_pop($sts);
                goto gt9;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 36');
                $sts[] = 36;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), SEMICOLON (;), PAREN_CLOSE ()), BLOCK_CLOSE (]), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st51:
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), SEMICOLON (;), NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), end of string or CURLY_CLOSE (}) at line ' . $el . ', column ' . $ec);
        st52:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 17 (MemberAccessExpression -> Expression DOT IDENTIFIER)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 17 (MemberAccessExpression -> Expression DOT IDENTIFIER)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 17 (MemberAccessExpression -> Expression DOT IDENTIFIER)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 17 (MemberAccessExpression -> Expression DOT IDENTIFIER)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 17 (MemberAccessExpression -> Expression DOT IDENTIFIER)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 17 (MemberAccessExpression -> Expression DOT IDENTIFIER)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 17 (MemberAccessExpression -> Expression DOT IDENTIFIER)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 17 (MemberAccessExpression -> Expression DOT IDENTIFIER)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt4;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 17 (MemberAccessExpression -> Expression DOT IDENTIFIER)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt4;
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
                $this->debugLog('Shifting to state 38');
                $sts[] = 38;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st38;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 37');
                $sts[] = 37;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Shifting to state 58');
                $sts[] = 58;
                $os[] = array(']');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st58;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 34');
                $sts[] = 34;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 35');
                $sts[] = 35;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 36');
                $sts[] = 36;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect BLOCK_CLOSE (]), INCREMENT (++), DECREMENT (--), DOT (.), BLOCK_OPEN ([) or PAREN_OPEN (() at line ' . $el . ', column ' . $ec);
        st54:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Shifting to state 59');
                $sts[] = 59;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st59;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Shifting to state 60');
                $sts[] = 60;
                $os[] = array(',');
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
        throw new \Exception('Expect PAREN_CLOSE ()) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st55:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 22 (FunctionCallExpression -> Expression PAREN_OPEN PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 22 (FunctionCallExpression -> Expression PAREN_OPEN PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 22 (FunctionCallExpression -> Expression PAREN_OPEN PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 22 (FunctionCallExpression -> Expression PAREN_OPEN PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 22 (FunctionCallExpression -> Expression PAREN_OPEN PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 22 (FunctionCallExpression -> Expression PAREN_OPEN PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 22 (FunctionCallExpression -> Expression PAREN_OPEN PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 22 (FunctionCallExpression -> Expression PAREN_OPEN PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 22 (FunctionCallExpression -> Expression PAREN_OPEN PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st56:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 38');
                $sts[] = 38;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st38;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 43 (ArgumentList -> Expression)');
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 37');
                $sts[] = 37;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 43 (ArgumentList -> Expression)');
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 34');
                $sts[] = 34;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 35');
                $sts[] = 35;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 36');
                $sts[] = 36;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect INCREMENT (++), DECREMENT (--), DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), PAREN_CLOSE ()) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st57:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 16 (ParenExpression -> PAREN_OPEN Expression PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceParenExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 16 (ParenExpression -> PAREN_OPEN Expression PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceParenExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 16 (ParenExpression -> PAREN_OPEN Expression PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceParenExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 16 (ParenExpression -> PAREN_OPEN Expression PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceParenExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 16 (ParenExpression -> PAREN_OPEN Expression PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceParenExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 16 (ParenExpression -> PAREN_OPEN Expression PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceParenExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 16 (ParenExpression -> PAREN_OPEN Expression PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceParenExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 16 (ParenExpression -> PAREN_OPEN Expression PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceParenExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 16 (ParenExpression -> PAREN_OPEN Expression PAREN_CLOSE)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceParenExpression($r1);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st58:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 18 (ComputedMemberAccessExpression -> Expression BLOCK_OPEN Expression BLOCK_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 18 (ComputedMemberAccessExpression -> Expression BLOCK_OPEN Expression BLOCK_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 18 (ComputedMemberAccessExpression -> Expression BLOCK_OPEN Expression BLOCK_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 18 (ComputedMemberAccessExpression -> Expression BLOCK_OPEN Expression BLOCK_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 18 (ComputedMemberAccessExpression -> Expression BLOCK_OPEN Expression BLOCK_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 18 (ComputedMemberAccessExpression -> Expression BLOCK_OPEN Expression BLOCK_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 18 (ComputedMemberAccessExpression -> Expression BLOCK_OPEN Expression BLOCK_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 18 (ComputedMemberAccessExpression -> Expression BLOCK_OPEN Expression BLOCK_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 18 (ComputedMemberAccessExpression -> Expression BLOCK_OPEN Expression BLOCK_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r2);
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
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st59:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Reducing by rule 21 (FunctionCallExpression -> Expression PAREN_OPEN ArgumentList PAREN_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 21 (FunctionCallExpression -> Expression PAREN_OPEN ArgumentList PAREN_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Reducing by rule 21 (FunctionCallExpression -> Expression PAREN_OPEN ArgumentList PAREN_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_CLOSE');
                $this->debugLog('Reducing by rule 21 (FunctionCallExpression -> Expression PAREN_OPEN ArgumentList PAREN_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 21 (FunctionCallExpression -> Expression PAREN_OPEN ArgumentList PAREN_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $this->debugLog('Encountered SEMICOLON');
                $this->debugLog('Reducing by rule 21 (FunctionCallExpression -> Expression PAREN_OPEN ArgumentList PAREN_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Reducing by rule 21 (FunctionCallExpression -> Expression PAREN_OPEN ArgumentList PAREN_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Reducing by rule 21 (FunctionCallExpression -> Expression PAREN_OPEN ArgumentList PAREN_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Reducing by rule 21 (FunctionCallExpression -> Expression PAREN_OPEN ArgumentList PAREN_CLOSE)');
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceFunctionCallExpression($r0, $r2);
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
        throw new \Exception('Expect SEMICOLON (;), PAREN_CLOSE ()), DOT (.), BLOCK_OPEN ([), BLOCK_CLOSE (]), PAREN_OPEN ((), INCREMENT (++), DECREMENT (--) or COMMA (,) at line ' . $el . ', column ' . $ec);
        st60:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 24');
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
                $this->debugLog('Encountered NOT');
                $this->debugLog('Shifting to state 13');
                $sts[] = 13;
                $os[] = array('!');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st13;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_INCREMENT');
                $this->debugLog('Shifting to state 17');
                $sts[] = 17;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, '+', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_PLUS');
                $this->debugLog('Shifting to state 15');
                $sts[] = 15;
                $os[] = array('+');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st15;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered PREFIX_DECREMENT');
                $this->debugLog('Shifting to state 18');
                $sts[] = 18;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (substr_compare($string, '-', $o, 1) === 0) {
                $this->debugLog('Encountered UNARY_NEGATION');
                $this->debugLog('Shifting to state 16');
                $sts[] = 16;
                $os[] = array('-');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st16;
            }
            if (substr_compare($string, '~', $o, 1) === 0) {
                $this->debugLog('Encountered TILDE');
                $this->debugLog('Shifting to state 14');
                $sts[] = 14;
                $os[] = array('~');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st14;
            }
            if (substr_compare($string, 'new ', $o, 4) === 0) {
                $this->debugLog('Encountered NEW_');
                $this->debugLog('Shifting to state 25');
                $sts[] = 25;
                $os[] = array('new ');
                $o += 4;
                goto st25;
            }
            if (substr_compare($string, 'delete ', $o, 7) === 0) {
                $this->debugLog('Encountered DELETE_');
                $this->debugLog('Shifting to state 21');
                $sts[] = 21;
                $os[] = array('delete ');
                $o += 7;
                goto st21;
            }
            if (substr_compare($string, 'typeof ', $o, 7) === 0) {
                $this->debugLog('Encountered TYPEOF_');
                $this->debugLog('Shifting to state 19');
                $sts[] = 19;
                $os[] = array('typeof ');
                $o += 7;
                goto st19;
            }
            if (substr_compare($string, 'void ', $o, 5) === 0) {
                $this->debugLog('Encountered VOID_');
                $this->debugLog('Shifting to state 20');
                $sts[] = 20;
                $os[] = array('void ');
                $o += 5;
                goto st20;
            }
            if (substr_compare($string, 'await ', $o, 6) === 0) {
                $this->debugLog('Encountered AWAIT_');
                $this->debugLog('Shifting to state 22');
                $sts[] = 22;
                $os[] = array('await ');
                $o += 6;
                goto st22;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered IDENTIFIER');
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
                $this->debugLog('Shifting to state 29');
                $sts[] = 29;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st29;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_INTEGER');
                $this->debugLog('Shifting to state 27');
                $sts[] = 27;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st27;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $this->debugLog('Encountered NUMBER_FLOAT');
                $this->debugLog('Shifting to state 28');
                $sts[] = 28;
                $os[] = $m;
                $o += strlen($m[0]);
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
        throw new \Exception('Expect NOT (!), TILDE (~), UNARY_PLUS (+), UNARY_NEGATION (-), PREFIX_INCREMENT (++), PREFIX_DECREMENT (--), TYPEOF_ (typeofspace), VOID_ (voidspace), DELETE_ (deletespace), AWAIT_ (awaitspace), IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), PAREN_OPEN ((), NEW_ (newspace), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
        st61:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_OPEN');
                $this->debugLog('Shifting to state 38');
                $sts[] = 38;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st38;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $this->debugLog('Encountered PAREN_CLOSE');
                $this->debugLog('Reducing by rule 42 (ArgumentList -> ArgumentList COMMA Expression)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $this->debugLog('Encountered BLOCK_OPEN');
                $this->debugLog('Shifting to state 37');
                $sts[] = 37;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $this->debugLog('Encountered COMMA');
                $this->debugLog('Reducing by rule 42 (ArgumentList -> ArgumentList COMMA Expression)');
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt12;
            }
            if (substr_compare($string, '++', $o, 2) === 0) {
                $this->debugLog('Encountered INCREMENT');
                $this->debugLog('Shifting to state 34');
                $sts[] = 34;
                $os[] = array('++');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st34;
            }
            if (substr_compare($string, '--', $o, 2) === 0) {
                $this->debugLog('Encountered DECREMENT');
                $this->debugLog('Shifting to state 35');
                $sts[] = 35;
                $os[] = array('--');
                $o += 2;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st35;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $this->debugLog('Encountered DOT');
                $this->debugLog('Shifting to state 36');
                $sts[] = 36;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect INCREMENT (++), DECREMENT (--), DOT (.), BLOCK_OPEN ([), PAREN_OPEN ((), PAREN_CLOSE ()) or COMMA (,) at line ' . $el . ', column ' . $ec);
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
                $sts[] = 32;
                $this->debugLog('Going to state 32');
                goto st32;
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
            case 19:
                $sts[] = 45;
                $this->debugLog('Going to state 45');
                goto st45;
            case 20:
                $sts[] = 46;
                $this->debugLog('Going to state 46');
                goto st46;
            case 21:
                $sts[] = 47;
                $this->debugLog('Going to state 47');
                goto st47;
            case 22:
                $sts[] = 48;
                $this->debugLog('Going to state 48');
                goto st48;
            case 24:
                $sts[] = 49;
                $this->debugLog('Going to state 49');
                goto st49;
            case 25:
                $sts[] = 50;
                $this->debugLog('Going to state 50');
                goto st50;
            case 37:
                $sts[] = 53;
                $this->debugLog('Going to state 53');
                goto st53;
            case 38:
                $sts[] = 56;
                $this->debugLog('Going to state 56');
                goto st56;
            case 60:
                $sts[] = 61;
                $this->debugLog('Going to state 61');
                goto st61;
        }
        gt4:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 6;
                $this->debugLog('Going to state 6');
                goto st6;
            case 2:
                $sts[] = 6;
                $this->debugLog('Going to state 6');
                goto st6;
            case 13:
                $sts[] = 6;
                $this->debugLog('Going to state 6');
                goto st6;
            case 14:
                $sts[] = 6;
                $this->debugLog('Going to state 6');
                goto st6;
            case 15:
                $sts[] = 6;
                $this->debugLog('Going to state 6');
                goto st6;
            case 16:
                $sts[] = 6;
                $this->debugLog('Going to state 6');
                goto st6;
            case 17:
                $sts[] = 6;
                $this->debugLog('Going to state 6');
                goto st6;
            case 18:
                $sts[] = 6;
                $this->debugLog('Going to state 6');
                goto st6;
            case 19:
                $sts[] = 6;
                $this->debugLog('Going to state 6');
                goto st6;
            case 20:
                $sts[] = 6;
                $this->debugLog('Going to state 6');
                goto st6;
            case 21:
                $sts[] = 6;
                $this->debugLog('Going to state 6');
                goto st6;
            case 22:
                $sts[] = 6;
                $this->debugLog('Going to state 6');
                goto st6;
            case 24:
                $sts[] = 6;
                $this->debugLog('Going to state 6');
                goto st6;
            case 25:
                $sts[] = 6;
                $this->debugLog('Going to state 6');
                goto st6;
            case 37:
                $sts[] = 6;
                $this->debugLog('Going to state 6');
                goto st6;
            case 38:
                $sts[] = 6;
                $this->debugLog('Going to state 6');
                goto st6;
            case 60:
                $sts[] = 6;
                $this->debugLog('Going to state 6');
                goto st6;
        }
        gt5:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 7;
                $this->debugLog('Going to state 7');
                goto st7;
            case 2:
                $sts[] = 7;
                $this->debugLog('Going to state 7');
                goto st7;
            case 13:
                $sts[] = 7;
                $this->debugLog('Going to state 7');
                goto st7;
            case 14:
                $sts[] = 7;
                $this->debugLog('Going to state 7');
                goto st7;
            case 15:
                $sts[] = 7;
                $this->debugLog('Going to state 7');
                goto st7;
            case 16:
                $sts[] = 7;
                $this->debugLog('Going to state 7');
                goto st7;
            case 17:
                $sts[] = 7;
                $this->debugLog('Going to state 7');
                goto st7;
            case 18:
                $sts[] = 7;
                $this->debugLog('Going to state 7');
                goto st7;
            case 19:
                $sts[] = 7;
                $this->debugLog('Going to state 7');
                goto st7;
            case 20:
                $sts[] = 7;
                $this->debugLog('Going to state 7');
                goto st7;
            case 21:
                $sts[] = 7;
                $this->debugLog('Going to state 7');
                goto st7;
            case 22:
                $sts[] = 7;
                $this->debugLog('Going to state 7');
                goto st7;
            case 24:
                $sts[] = 7;
                $this->debugLog('Going to state 7');
                goto st7;
            case 25:
                $sts[] = 7;
                $this->debugLog('Going to state 7');
                goto st7;
            case 37:
                $sts[] = 7;
                $this->debugLog('Going to state 7');
                goto st7;
            case 38:
                $sts[] = 7;
                $this->debugLog('Going to state 7');
                goto st7;
            case 60:
                $sts[] = 7;
                $this->debugLog('Going to state 7');
                goto st7;
        }
        gt6:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 8;
                $this->debugLog('Going to state 8');
                goto st8;
            case 2:
                $sts[] = 8;
                $this->debugLog('Going to state 8');
                goto st8;
            case 13:
                $sts[] = 8;
                $this->debugLog('Going to state 8');
                goto st8;
            case 14:
                $sts[] = 8;
                $this->debugLog('Going to state 8');
                goto st8;
            case 15:
                $sts[] = 8;
                $this->debugLog('Going to state 8');
                goto st8;
            case 16:
                $sts[] = 8;
                $this->debugLog('Going to state 8');
                goto st8;
            case 17:
                $sts[] = 8;
                $this->debugLog('Going to state 8');
                goto st8;
            case 18:
                $sts[] = 8;
                $this->debugLog('Going to state 8');
                goto st8;
            case 19:
                $sts[] = 8;
                $this->debugLog('Going to state 8');
                goto st8;
            case 20:
                $sts[] = 8;
                $this->debugLog('Going to state 8');
                goto st8;
            case 21:
                $sts[] = 8;
                $this->debugLog('Going to state 8');
                goto st8;
            case 22:
                $sts[] = 8;
                $this->debugLog('Going to state 8');
                goto st8;
            case 24:
                $sts[] = 8;
                $this->debugLog('Going to state 8');
                goto st8;
            case 25:
                $sts[] = 8;
                $this->debugLog('Going to state 8');
                goto st8;
            case 37:
                $sts[] = 8;
                $this->debugLog('Going to state 8');
                goto st8;
            case 38:
                $sts[] = 8;
                $this->debugLog('Going to state 8');
                goto st8;
            case 60:
                $sts[] = 8;
                $this->debugLog('Going to state 8');
                goto st8;
        }
        gt7:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 9;
                $this->debugLog('Going to state 9');
                goto st9;
            case 2:
                $sts[] = 9;
                $this->debugLog('Going to state 9');
                goto st9;
            case 13:
                $sts[] = 9;
                $this->debugLog('Going to state 9');
                goto st9;
            case 14:
                $sts[] = 9;
                $this->debugLog('Going to state 9');
                goto st9;
            case 15:
                $sts[] = 9;
                $this->debugLog('Going to state 9');
                goto st9;
            case 16:
                $sts[] = 9;
                $this->debugLog('Going to state 9');
                goto st9;
            case 17:
                $sts[] = 9;
                $this->debugLog('Going to state 9');
                goto st9;
            case 18:
                $sts[] = 9;
                $this->debugLog('Going to state 9');
                goto st9;
            case 19:
                $sts[] = 9;
                $this->debugLog('Going to state 9');
                goto st9;
            case 20:
                $sts[] = 9;
                $this->debugLog('Going to state 9');
                goto st9;
            case 21:
                $sts[] = 9;
                $this->debugLog('Going to state 9');
                goto st9;
            case 22:
                $sts[] = 9;
                $this->debugLog('Going to state 9');
                goto st9;
            case 24:
                $sts[] = 9;
                $this->debugLog('Going to state 9');
                goto st9;
            case 25:
                $sts[] = 9;
                $this->debugLog('Going to state 9');
                goto st9;
            case 37:
                $sts[] = 9;
                $this->debugLog('Going to state 9');
                goto st9;
            case 38:
                $sts[] = 9;
                $this->debugLog('Going to state 9');
                goto st9;
            case 60:
                $sts[] = 9;
                $this->debugLog('Going to state 9');
                goto st9;
        }
        gt8:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 10;
                $this->debugLog('Going to state 10');
                goto st10;
            case 2:
                $sts[] = 10;
                $this->debugLog('Going to state 10');
                goto st10;
            case 13:
                $sts[] = 10;
                $this->debugLog('Going to state 10');
                goto st10;
            case 14:
                $sts[] = 10;
                $this->debugLog('Going to state 10');
                goto st10;
            case 15:
                $sts[] = 10;
                $this->debugLog('Going to state 10');
                goto st10;
            case 16:
                $sts[] = 10;
                $this->debugLog('Going to state 10');
                goto st10;
            case 17:
                $sts[] = 10;
                $this->debugLog('Going to state 10');
                goto st10;
            case 18:
                $sts[] = 10;
                $this->debugLog('Going to state 10');
                goto st10;
            case 19:
                $sts[] = 10;
                $this->debugLog('Going to state 10');
                goto st10;
            case 20:
                $sts[] = 10;
                $this->debugLog('Going to state 10');
                goto st10;
            case 21:
                $sts[] = 10;
                $this->debugLog('Going to state 10');
                goto st10;
            case 22:
                $sts[] = 10;
                $this->debugLog('Going to state 10');
                goto st10;
            case 24:
                $sts[] = 10;
                $this->debugLog('Going to state 10');
                goto st10;
            case 25:
                $sts[] = 10;
                $this->debugLog('Going to state 10');
                goto st10;
            case 37:
                $sts[] = 10;
                $this->debugLog('Going to state 10');
                goto st10;
            case 38:
                $sts[] = 10;
                $this->debugLog('Going to state 10');
                goto st10;
            case 60:
                $sts[] = 10;
                $this->debugLog('Going to state 10');
                goto st10;
        }
        gt9:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 11;
                $this->debugLog('Going to state 11');
                goto st11;
            case 2:
                $sts[] = 11;
                $this->debugLog('Going to state 11');
                goto st11;
            case 13:
                $sts[] = 11;
                $this->debugLog('Going to state 11');
                goto st11;
            case 14:
                $sts[] = 11;
                $this->debugLog('Going to state 11');
                goto st11;
            case 15:
                $sts[] = 11;
                $this->debugLog('Going to state 11');
                goto st11;
            case 16:
                $sts[] = 11;
                $this->debugLog('Going to state 11');
                goto st11;
            case 17:
                $sts[] = 11;
                $this->debugLog('Going to state 11');
                goto st11;
            case 18:
                $sts[] = 11;
                $this->debugLog('Going to state 11');
                goto st11;
            case 19:
                $sts[] = 11;
                $this->debugLog('Going to state 11');
                goto st11;
            case 20:
                $sts[] = 11;
                $this->debugLog('Going to state 11');
                goto st11;
            case 21:
                $sts[] = 11;
                $this->debugLog('Going to state 11');
                goto st11;
            case 22:
                $sts[] = 11;
                $this->debugLog('Going to state 11');
                goto st11;
            case 24:
                $sts[] = 11;
                $this->debugLog('Going to state 11');
                goto st11;
            case 25:
                $sts[] = 11;
                $this->debugLog('Going to state 11');
                goto st11;
            case 37:
                $sts[] = 11;
                $this->debugLog('Going to state 11');
                goto st11;
            case 38:
                $sts[] = 11;
                $this->debugLog('Going to state 11');
                goto st11;
            case 60:
                $sts[] = 11;
                $this->debugLog('Going to state 11');
                goto st11;
        }
        gt10:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 12;
                $this->debugLog('Going to state 12');
                goto st12;
            case 2:
                $sts[] = 12;
                $this->debugLog('Going to state 12');
                goto st12;
            case 13:
                $sts[] = 12;
                $this->debugLog('Going to state 12');
                goto st12;
            case 14:
                $sts[] = 12;
                $this->debugLog('Going to state 12');
                goto st12;
            case 15:
                $sts[] = 12;
                $this->debugLog('Going to state 12');
                goto st12;
            case 16:
                $sts[] = 12;
                $this->debugLog('Going to state 12');
                goto st12;
            case 17:
                $sts[] = 12;
                $this->debugLog('Going to state 12');
                goto st12;
            case 18:
                $sts[] = 12;
                $this->debugLog('Going to state 12');
                goto st12;
            case 19:
                $sts[] = 12;
                $this->debugLog('Going to state 12');
                goto st12;
            case 20:
                $sts[] = 12;
                $this->debugLog('Going to state 12');
                goto st12;
            case 21:
                $sts[] = 12;
                $this->debugLog('Going to state 12');
                goto st12;
            case 22:
                $sts[] = 12;
                $this->debugLog('Going to state 12');
                goto st12;
            case 24:
                $sts[] = 12;
                $this->debugLog('Going to state 12');
                goto st12;
            case 25:
                $sts[] = 12;
                $this->debugLog('Going to state 12');
                goto st12;
            case 37:
                $sts[] = 12;
                $this->debugLog('Going to state 12');
                goto st12;
            case 38:
                $sts[] = 12;
                $this->debugLog('Going to state 12');
                goto st12;
            case 60:
                $sts[] = 12;
                $this->debugLog('Going to state 12');
                goto st12;
        }
        gt11:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 26;
                $this->debugLog('Going to state 26');
                goto st26;
            case 2:
                $sts[] = 26;
                $this->debugLog('Going to state 26');
                goto st26;
            case 13:
                $sts[] = 26;
                $this->debugLog('Going to state 26');
                goto st26;
            case 14:
                $sts[] = 26;
                $this->debugLog('Going to state 26');
                goto st26;
            case 15:
                $sts[] = 26;
                $this->debugLog('Going to state 26');
                goto st26;
            case 16:
                $sts[] = 26;
                $this->debugLog('Going to state 26');
                goto st26;
            case 17:
                $sts[] = 26;
                $this->debugLog('Going to state 26');
                goto st26;
            case 18:
                $sts[] = 26;
                $this->debugLog('Going to state 26');
                goto st26;
            case 19:
                $sts[] = 26;
                $this->debugLog('Going to state 26');
                goto st26;
            case 20:
                $sts[] = 26;
                $this->debugLog('Going to state 26');
                goto st26;
            case 21:
                $sts[] = 26;
                $this->debugLog('Going to state 26');
                goto st26;
            case 22:
                $sts[] = 26;
                $this->debugLog('Going to state 26');
                goto st26;
            case 24:
                $sts[] = 26;
                $this->debugLog('Going to state 26');
                goto st26;
            case 25:
                $sts[] = 26;
                $this->debugLog('Going to state 26');
                goto st26;
            case 37:
                $sts[] = 26;
                $this->debugLog('Going to state 26');
                goto st26;
            case 38:
                $sts[] = 26;
                $this->debugLog('Going to state 26');
                goto st26;
            case 60:
                $sts[] = 26;
                $this->debugLog('Going to state 26');
                goto st26;
        }
        gt12:
        switch ($sts[count($sts) - 1]) {
            case 38:
                $sts[] = 54;
                $this->debugLog('Going to state 54');
                goto st54;
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