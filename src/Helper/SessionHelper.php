<?php
declare(strict_types=1);

namespace App\Helper;

/**
 * Class SessionHelper
 * @package App\Helper
 */
class SessionHelper
{
    /**
     * Return $_SESSION array
     *
     * @return array
     */
    public static function getSession(): array
    {
        return $_SESSION;
    }

    /**
     * Return from $_SESSION given key if exists or null
     *
     * @param string $key
     * @return mixed
     */
    public static function getSessionValue(string $key): mixed
    {
        return self::getSession()[$key] ?? null;
    }

    /**
     * Sets given key given value in $_SESSION
     *
     * @param string $key
     * @param mixed $value
     */
    public static function addSession(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Unsets given key if it exists in $_SESSION
     *
     * @param string $key
     */
    public static function removeSession(string $key): void
    {
        if (array_key_exists($key, self::getSession())){
            unset($_SESSION[$key]);
        }
    }

    /**
     * Append value to given $_SESSION key if exists. If not exists add key with array wit value
     *
     * @param string $key
     * @param mixed $value
     */
    public static function appendSession(string $key, mixed $value): void
    {
        if (!array_key_exists($key, self::getSession())){
            self::addSession($key, [$value]);
            return;
        }
        
        if (!is_array(self::getSessionValue($key))){
            $tmp = self::getSessionValue($key);
            self::addSession($key, [$tmp, $value]);

            return;
        }

        $tmp = self::getSessionValue($key);
        $tmp[] = $value;
        self::addSession($key, $tmp);
    }
}
