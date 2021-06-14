<?php
declare(strict_types=1);

namespace App\Helper;

/**
 * Class SettingHelper
 * @package App\Helper
 */
class SettingHelper
{
    /**
     * Return value from env with database prefix
     *
     * @param string $key
     * @return string|null
     */
    public static function getDatabaseEnv(string $key): ?string
    {
        return self::getEnv('database.' . $key);
    }

    /**
     * Return value from $_ENV array
     *
     * @param string $key
     * @return string|null
     */
    public static function getEnv(string $key): ?string
    {
        if (isset($_ENV[$key])) {
            return $_ENV[$key];
        }

        return null;
    }

    /**
     * Return value from env with base prefix
     *
     * @param string $key
     * @return string|null
     */
    public static function getBaseEnv(string $key): ?string
    {
        return self::getEnv('base.' . $key);
    }
}
