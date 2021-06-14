<?php
declare(strict_types=1);

namespace App\Helper;

/**
 * Class GlobalHelper
 * @package App\Helper
 */
class GlobalHelper
{
    /**
     * Var dump data with inside pre tag. If exit param is pass as true function call exit
     *
     * @param $data
     * @param bool $exit
     */
    public static function dump($data, bool $exit = true)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';

        if ($exit) {
            exit;
        }

        return;
    }

    /**
     * Return given variable casted to given type
     *
     * @param $var
     * @param string $typeToCast
     * @return bool|int
     */
    public static function castToType($var, string $typeToCast)
    {
        return match ($typeToCast) {
            'integer' => intval($var),
            'string' => boolval($var),
        };
    }
}
