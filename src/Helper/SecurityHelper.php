<?php
declare(strict_types=1);

namespace App\Helper;

/**
 * Class SecurityHelper
 * @package App\Helper
 */
class SecurityHelper
{
    /**
     * Sanitizes given value
     *
     * @param mixed $var
     * @return mixed
     */
    public static function sanitizeVar(mixed $var): mixed
    {
        return filter_var($var, FILTER_SANITIZE_STRING);
    }
}
