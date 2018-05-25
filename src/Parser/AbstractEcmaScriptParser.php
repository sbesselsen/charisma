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
        goto st0;
        st0:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                goto st6;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st7;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 10;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st10;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 8;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st8;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 9;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st9;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
                $sts[] = 4;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st4;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), (, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
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
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                goto st6;
            }
            if (substr_compare($string, '}', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceCodeBlockContent($r0);
                array_pop($sts);
                goto gt0;
            }
            if (substr_compare($string, ';', $o, 1) === 0) {
                $sts[] = 12;
                $os[] = array(';');
                $o += 1;
                goto st12;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st7;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 10;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st10;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 8;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st8;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 9;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st9;
            }
            if (preg_match('((\\s+|/\\/*.*?\\*/|//[^\\n]*)+)ADs', $string, $m, 0, $o)) {
                $sts[] = 11;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st11;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, (, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), end of string or } at line ' . $el . ', column ' . $ec);
        st3:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $sts[] = 14;
                $os[] = array(';');
                $o += 1;
                goto st14;
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, (, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), end of string or } at line ' . $el . ', column ' . $ec);
        st5:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceExpressionStatement($r0);
                array_pop($sts);
                goto gt2;
            }
            if (preg_match('(\\s*)ADs', $string, $m, 0, $o)) {
                $sts[] = 15;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st15;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect _ (\\s*) or ; at line ' . $el . ', column ' . $ec);
        st6:
        if ($l > $o) {
            if (preg_match('(\\s*)ADs', $string, $m, 0, $o)) {
                $sts[] = 16;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st16;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect _ (\\s*) at line ' . $el . ', column ' . $ec);
        st7:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (preg_match('(\\s*)ADs', $string, $m, 0, $o)) {
                $r0 = array_pop($os);
                $os[] = $this->reduceVariableAccessExpression($r0);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ; or _ (\\s*) at line ' . $el . ', column ' . $ec);
        st8:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (preg_match('(\\s*)ADs', $string, $m, 0, $o)) {
                $r0 = array_pop($os);
                $os[] = $this->reduceIntegerNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ; or _ (\\s*) at line ' . $el . ', column ' . $ec);
        st9:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (preg_match('(\\s*)ADs', $string, $m, 0, $o)) {
                $r0 = array_pop($os);
                $os[] = $this->reduceFloatNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ; or _ (\\s*) at line ' . $el . ', column ' . $ec);
        st10:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
            if (preg_match('(\\s*)ADs', $string, $m, 0, $o)) {
                $r0 = array_pop($os);
                $os[] = $this->reduceOctalNumberExpression($r0);
                array_pop($sts);
                goto gt3;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ; or _ (\\s*) at line ' . $el . ', column ' . $ec);
        st11:
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, (, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), end of string or } at line ' . $el . ', column ' . $ec);
        st12:
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, (, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), end of string or } at line ' . $el . ', column ' . $ec);
        st13:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $sts[] = 17;
                $os[] = array(';');
                $o += 1;
                goto st17;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ; at line ' . $el . ', column ' . $ec);
        st14:
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, (, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), end of string or } at line ' . $el . ', column ' . $ec);
        st15:
        if ($l > $o) {
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 19;
                $os[] = array('[');
                $o += 1;
                goto st19;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 18;
                $os[] = array('.');
                $o += 1;
                goto st18;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect . or [ at line ' . $el . ', column ' . $ec);
        st16:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                goto st6;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st7;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 10;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st10;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 8;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st8;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 9;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st9;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect (, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
        st17:
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
        throw new \Exception('Expect NONCODE ((\\s+|/\\/*.*?\\*/|//[^\\n]*)+), ;, (, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+), NUMBER_OCTAL (0x[0-9abcdefABCDEF]+), end of string or } at line ' . $el . ', column ' . $ec);
        st18:
        if ($l > $o) {
            if (preg_match('(\\s*)ADs', $string, $m, 0, $o)) {
                $sts[] = 21;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st21;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect _ (\\s*) at line ' . $el . ', column ' . $ec);
        st19:
        if ($l > $o) {
            if (preg_match('(\\s*)ADs', $string, $m, 0, $o)) {
                $sts[] = 22;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st22;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect _ (\\s*) at line ' . $el . ', column ' . $ec);
        st20:
        if ($l > $o) {
            if (preg_match('(\\s*)ADs', $string, $m, 0, $o)) {
                $sts[] = 23;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st23;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect _ (\\s*) at line ' . $el . ', column ' . $ec);
        st21:
        if ($l > $o) {
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 24;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st24;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*) at line ' . $el . ', column ' . $ec);
        st22:
        if ($l > $o) {
            if (substr_compare($string, '(', $o, 1) === 0) {
                $sts[] = 6;
                $os[] = array('(');
                $o += 1;
                goto st6;
            }
            if (preg_match('([a-zA-Z_$][a-zA-Z_0-9$]*)ADs', $string, $m, 0, $o)) {
                $sts[] = 7;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st7;
            }
            if (preg_match('(0x[0-9abcdefABCDEF]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 10;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st10;
            }
            if (preg_match('([0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 8;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st8;
            }
            if (preg_match('([0-9]+\\.[0-9]+)ADs', $string, $m, 0, $o)) {
                $sts[] = 9;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st9;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect (, IDENTIFIER ([a-zA-Z_$][a-zA-Z_0-9$]*), NUMBER_INTEGER ([0-9]+), NUMBER_FLOAT ([0-9]+\\.[0-9]+) or NUMBER_OCTAL (0x[0-9abcdefABCDEF]+) at line ' . $el . ', column ' . $ec);
        st23:
        if ($l > $o) {
            if (substr_compare($string, ')', $o, 1) === 0) {
                $sts[] = 26;
                $os[] = array(')');
                $o += 1;
                goto st26;
            }
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 19;
                $os[] = array('[');
                $o += 1;
                goto st19;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 18;
                $os[] = array('.');
                $o += 1;
                goto st18;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ), . or [ at line ' . $el . ', column ' . $ec);
        st24:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r4);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (preg_match('(\\s*)ADs', $string, $m, 0, $o)) {
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceMemberAccessExpression($r0, $r4);
                array_pop($sts);
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
        throw new \Exception('Expect ; or _ (\\s*) at line ' . $el . ', column ' . $ec);
        st25:
        if ($l > $o) {
            if (preg_match('(\\s*)ADs', $string, $m, 0, $o)) {
                $sts[] = 27;
                $os[] = $m;
                $o += strlen($m[0]);
                goto st27;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect _ (\\s*) at line ' . $el . ', column ' . $ec);
        st26:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r2;
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (preg_match('(\\s*)ADs', $string, $m, 0, $o)) {
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $r2;
                array_pop($sts);
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
        throw new \Exception('Expect ; or _ (\\s*) at line ' . $el . ', column ' . $ec);
        st27:
        if ($l > $o) {
            if (substr_compare($string, '[', $o, 1) === 0) {
                $sts[] = 19;
                $os[] = array('[');
                $o += 1;
                goto st19;
            }
            if (substr_compare($string, ']', $o, 1) === 0) {
                $sts[] = 28;
                $os[] = array(']');
                $o += 1;
                goto st28;
            }
            if (substr_compare($string, '.', $o, 1) === 0) {
                $sts[] = 18;
                $os[] = array('.');
                $o += 1;
                goto st18;
            }
        }
        $els = explode("\n", substr($string, 0, $o));
        $el = count($els);
        $ec = strlen(array_pop($els)) + 1;
        throw new \Exception('Expect ], . or [ at line ' . $el . ', column ' . $ec);
        st28:
        if ($l > $o) {
            if (substr_compare($string, ';', $o, 1) === 0) {
                $r6 = array_pop($os);
                $r5 = array_pop($os);
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r4);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
                goto gt3;
            }
            if (preg_match('(\\s*)ADs', $string, $m, 0, $o)) {
                $r6 = array_pop($os);
                $r5 = array_pop($os);
                $r4 = array_pop($os);
                $r3 = array_pop($os);
                $r2 = array_pop($os);
                $r1 = array_pop($os);
                $r0 = array_pop($os);
                $os[] = $this->reduceComputedMemberAccessExpression($r0, $r4);
                array_pop($sts);
                array_pop($sts);
                array_pop($sts);
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
        throw new \Exception('Expect ; or _ (\\s*) at line ' . $el . ', column ' . $ec);
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
                $sts[] = 13;
                goto st13;
        }
        gt3:
        switch ($sts[count($sts) - 1]) {
            case 0:
                $sts[] = 5;
                goto st5;
            case 2:
                $sts[] = 5;
                goto st5;
            case 16:
                $sts[] = 20;
                goto st20;
            case 22:
                $sts[] = 25;
                goto st25;
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
    protected abstract function reduceIntegerNumberExpression($p0);
    protected abstract function reduceFloatNumberExpression($p0);
    protected abstract function reduceOctalNumberExpression($p0);
}