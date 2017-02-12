<?php

class Prime
{

    private static $countTest = 10;  // error probability -> pow((1/4), $countTest)

    /**
     * 
     * @param int $m
     * @param int $n
     * @return mixed int or boolean
     */

    public static function findPrimeMiddleValue($m, $n)
    {

        $lthRng = (int) ($n - $m);

        $midRange = (int) (round(($m + $n) / 2));

        for ($i = 0; $i <= round($lthRng / 2); $i++)
        {

            $rght = $midRange + $i;
            if ($rght < $n && self::isPrime($rght))
                return $rght;


            $lft = $midRange - $i;
            if ($i !== 0 && $lft > $m && self::isPrime($lft))
                return $lft;
        }
        return FALSE;
    }

    /**
     * version for test
     * !!! not used !!!
     * 
     * @param int $n
     * @return boolean
     */
    public static function isPrimeForCheckNextAlgoritm($n)
    {
        for ($x = 2; $x <= sqrt($n); $x++)
        {
            if ($n % $x == 0)
            {
                return FALSE;
            }
        }
        return TRUE;
    }

    /**
     * 
     * https://ru.wikipedia.org/wiki/%D0%A2%D0%B5%D1%81%D1%82_%D0%9C%D0%B8%D0%BB%D0%BB%D0%B5%D1%80%D0%B0_%E2%80%94_%D0%A0%D0%B0%D0%B1%D0%B8%D0%BD%D0%B0
     * 
     * @param int $n
     * @return boolean
     */
    public static function isPrime($n)
    {
        if ($n == 2)
            return TRUE;
        if ($n < 2 || $n % 2 == 0)
            return FALSE;

        $d = $n - 1;
        $s = 0;

        while ($d % 2 == 0)
        {
            $d /= 2;
            $s++;
        }

        for ($i = 0; $i < self::$countTest; $i++)
        {
            $a = rand(2, $n - 1);

            $x = bcpowmod($a, $d, $n);
            if ($x == 1 || $x == $n - 1)
                continue;

            for ($j = 1; $j < $s; $j++)
            {
                $x = bcmod(bcmul($x, $x), $n);
                if ($x == 1)
                    return FALSE;
                if ($x == $n - 1)
                    continue 2;
            }
            return FALSE;
        }
        return TRUE;
    }

}

$start = microtime(TRUE);

$m = 3;
$n = 11;

$val = Prime::findPrimeMiddleValue($m, $n);
printf('Ближе всего к центру интервала: %d %s', $val, '<br>');



$time = microtime(TRUE) - $start;
printf('Скрипт выполнялся %.4F сек. %s', $time, '<br>');




