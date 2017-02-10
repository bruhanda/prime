<?php

class Prime
{

    public static function middleValue($m, $n)
    {

        $primes = array();
        for ($i = $m; $i <= $n; $i++)
        {
            if (self::check_prime($i))
            {
                $primes[] = $i;
            }
        }
        $middle = $n - (($n - $m) / 2);
        $nearest = self::searchNearestValue($middle, $primes);
        return $nearest;
    }

    public static function check_prime($n)
    {
        for ($x = 2; $x <= sqrt($n); $x++)
        {
            if ($n % $x == 0)
            {
                return false;
            }
        }
        return true;
    }

    public static function searchNearestValue($value, $array)
    {
        $lastKey = null;
        $lastDif = null;
        foreach ($array as $k => $v)
        {
            if ($v == $value)
            {
                return $array[$k];
            }
            $dif = abs($value - $v);
            if (is_null($lastKey) || $dif < $lastDif)
            {
                $lastKey = $k;
                $lastDif = $dif;
            }
        }
        return $array[$lastKey];
    }

}

$val = Prime::middleValue(3, 456);
var_dump($val);
die;

