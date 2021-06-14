<?php
declare(strict_types=1);

namespace App\Helper;

/**
 * Class ResponseHelper
 * @package App\Helper
 */
class ResponseHelper
{
    /**
     * Redirect to given url with proper response code based on permanent parameter value
     *
     * @param string $url
     * @param bool $permanent
     */
    public static function redirect(string $url, bool $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);

        exit;
    }
}
