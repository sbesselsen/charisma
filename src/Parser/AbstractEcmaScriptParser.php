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
                $sts[] = 17;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 16;
                $os[] = array('new');
                $o += 3;
                goto st16;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 18;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 11;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 9;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 10;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
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
                $sts[] = 17;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, '}', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceCodeBlockContent($r0);
                array_pop($sts);
                goto gt0;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $sts[] = 20;
                $os[] = array(';');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st20;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 16;
                $os[] = array('new');
                $o += 3;
                goto st16;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 18;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 11;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 9;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 10;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
                $sts[] = 19;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st19;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, (, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), end of string or } at line ' . $el . ', column ' . $ec);
        st3:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $sts[] = 22;
                $os[] = array(';');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st22;
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
            if (substr_compare($string, 'new', $o, 3) === 0) {
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, (, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), end of string or } at line ' . $el . ', column ' . $ec);
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
                $sts[] = 23;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st23;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $r0;
                array_pop($sts);
                goto gt3;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 25;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st25;
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
                $sts[] = 24;
                $os[] = array('.');
                $o += 1;
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
        st10:
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
        st11:
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
        st12:
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
        st13:
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
        st14:
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
        st15:
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
        st16:
        if ($l > $o) {
            if (($ml = strspn($string, '
	 ', $o)) > 0) {
                $sts[] = 26;
                $os[] = array(substr($string, $o, $ml));
                $o += $ml;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st26;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect  at line ' . $el . ', column ' . $ec);
        st17:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 17;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 16;
                $os[] = array('new');
                $o += 3;
                goto st16;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 18;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 11;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 9;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 10;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st18:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt10;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt10;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ., [, (, ), ] or , at line ' . $el . ', column ' . $ec);
        st19:
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
            if (substr_compare($string, 'new', $o, 3) === 0) {
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, (, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), end of string or } at line ' . $el . ', column ' . $ec);
        st20:
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
            if (substr_compare($string, 'new', $o, 3) === 0) {
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, (, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), end of string or } at line ' . $el . ', column ' . $ec);
        st21:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $sts[] = 28;
                $os[] = array(';');
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
        throw new \Exception('Expect ; at line ' . $el . ', column ' . $ec);
        st22:
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
            if (substr_compare($string, 'new', $o, 3) === 0) {
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, (, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), end of string or } at line ' . $el . ', column ' . $ec);
        st23:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 17;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $sts[] = 30;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st30;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 16;
                $os[] = array('new');
                $o += 3;
                goto st16;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 18;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 11;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 9;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 10;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st24:
        if ($l > $o) {
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 32;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st32;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st25:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 17;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 16;
                $os[] = array('new');
                $o += 3;
                goto st16;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 18;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 11;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 9;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 10;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st26:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 17;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 18;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st27:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $sts[] = 35;
                $os[] = array(')');
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
        throw new \Exception('Expect ) at line ' . $el . ', column ' . $ec);
        st28:
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, (, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), end of string or } at line ' . $el . ', column ' . $ec);
        st29:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $sts[] = 36;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st36;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $sts[] = 37;
                $os[] = array(',');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ) or , at line ' . $el . ', column ' . $ec);
        st30:
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
        st31:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->arrayOf($r0);
                array_pop($sts);
                goto gt11;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ) or , at line ' . $el . ', column ' . $ec);
        st32:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt8;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r2);
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
        st33:
        if ($l > $o) {
            if (substr_compare($string, ']', $o, 1) === 0) {
                $sts[] = 38;
                $os[] = array(']');
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
        throw new \Exception('Expect ] at line ' . $el . ', column ' . $ec);
        st34:
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
                $os[] = $this->reduceNewExpression($r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt5;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 25;
                $os[] = array('[');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st25;
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
                $sts[] = 24;
                $os[] = array('.');
                $o += 1;
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
        throw new \Exception('Expect (, ., [, ;, ), ] or , at line ' . $el . ', column ' . $ec);
        st35:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r1;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt7;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ., [, (, ), ] or , at line ' . $el . ', column ' . $ec);
        st36:
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
        st37:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 17;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 16;
                $os[] = array('new');
                $o += 3;
                goto st16;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 18;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 11;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 9;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 10;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st38:
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
                goto gt9;
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
                goto gt9;
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
                goto gt9;
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
                goto gt9;
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
                goto gt9;
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
                goto gt9;
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
                goto gt9;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ;, ., [, (, ), ] or , at line ' . $el . ', column ' . $ec);
        st39:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 17;
                $os[] = array('(');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st17;
            }
            if (substr_compare($string, ')', $o, 1) === 0) {
                $sts[] = 42;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st42;
            }
            if (substr_compare($string, 'new', $o, 3) === 0) {
                $sts[] = 16;
                $os[] = array('new');
                $o += 3;
                goto st16;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 18;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st18;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 11;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st11;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 9;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st9;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 10;
                $os[] = $m;
                $o += strlen($m[0]);
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st10;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), new, ( or IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st40:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt11;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->arrayPush($r0, $r2);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt11;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ) or , at line ' . $el . ', column ' . $ec);
        st41:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $sts[] = 43;
                $os[] = array(')');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st43;
            }
            if (substr_compare($string, ',', $o, 1) === 0) {
                $sts[] = 37;
                $os[] = array(',');
                $o += 1;
                if (($ml = strspn($string, '
	 ', $o)) > 0) {
                    $o += $ml;
                }
                goto st37;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ) or , at line ' . $el . ', column ' . $ec);
        st42:
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
        st43:
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
                $sts[] = 21;
                goto st21;
        }
        gt3:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 5;
                goto st5;
            case 2:
                $sts[] = 5;
                goto st5;
            case 17:
                $sts[] = 27;
                goto st27;
            case 23:
                $sts[] = 31;
                goto st31;
            case 25:
                $sts[] = 33;
                goto st33;
            case 37:
                $sts[] = 40;
                goto st40;
            case 39:
                $sts[] = 31;
                goto st31;
        }
        gt4:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 6;
                goto st6;
            case 2:
                $sts[] = 6;
                goto st6;
            case 17:
                $sts[] = 6;
                goto st6;
            case 23:
                $sts[] = 6;
                goto st6;
            case 25:
                $sts[] = 6;
                goto st6;
            case 26:
                $sts[] = 34;
                goto st34;
            case 37:
                $sts[] = 6;
                goto st6;
            case 39:
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
            case 17:
                $sts[] = 7;
                goto st7;
            case 23:
                $sts[] = 7;
                goto st7;
            case 25:
                $sts[] = 7;
                goto st7;
            case 37:
                $sts[] = 7;
                goto st7;
            case 39:
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
            case 17:
                $sts[] = 8;
                goto st8;
            case 23:
                $sts[] = 8;
                goto st8;
            case 25:
                $sts[] = 8;
                goto st8;
            case 37:
                $sts[] = 8;
                goto st8;
            case 39:
                $sts[] = 8;
                goto st8;
        }
        gt7:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 12;
                goto st12;
            case 2:
                $sts[] = 12;
                goto st12;
            case 17:
                $sts[] = 12;
                goto st12;
            case 23:
                $sts[] = 12;
                goto st12;
            case 25:
                $sts[] = 12;
                goto st12;
            case 26:
                $sts[] = 12;
                goto st12;
            case 37:
                $sts[] = 12;
                goto st12;
            case 39:
                $sts[] = 12;
                goto st12;
        }
        gt8:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 13;
                goto st13;
            case 2:
                $sts[] = 13;
                goto st13;
            case 17:
                $sts[] = 13;
                goto st13;
            case 23:
                $sts[] = 13;
                goto st13;
            case 25:
                $sts[] = 13;
                goto st13;
            case 26:
                $sts[] = 13;
                goto st13;
            case 37:
                $sts[] = 13;
                goto st13;
            case 39:
                $sts[] = 13;
                goto st13;
        }
        gt9:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 14;
                goto st14;
            case 2:
                $sts[] = 14;
                goto st14;
            case 17:
                $sts[] = 14;
                goto st14;
            case 23:
                $sts[] = 14;
                goto st14;
            case 25:
                $sts[] = 14;
                goto st14;
            case 26:
                $sts[] = 14;
                goto st14;
            case 37:
                $sts[] = 14;
                goto st14;
            case 39:
                $sts[] = 14;
                goto st14;
        }
        gt10:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 15;
                goto st15;
            case 2:
                $sts[] = 15;
                goto st15;
            case 17:
                $sts[] = 15;
                goto st15;
            case 23:
                $sts[] = 15;
                goto st15;
            case 25:
                $sts[] = 15;
                goto st15;
            case 26:
                $sts[] = 15;
                goto st15;
            case 37:
                $sts[] = 15;
                goto st15;
            case 39:
                $sts[] = 15;
                goto st15;
        }
        gt11:
        switch ($sts[count($sts) - 1]) {
            case 23:
                $sts[] = 29;
                goto st29;
            case 39:
                $sts[] = 41;
                goto st41;
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
    protected abstract function reduceIntegerNumberExpression($p0);
    protected abstract function reduceFloatNumberExpression($p0);
    protected abstract function reduceOctalNumberExpression($p0);
}