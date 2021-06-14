<?php
declare(strict_types=1);

namespace App\Library;

use App\Helper\SettingHelper;
use PDO;

/**
 * Class Database
 * @package App\Library
 */
class Database
{
    /**
     * @var PDO
     */
    protected static PDO $instance;

    /**
     * Return instance of database connection
     *
     * @return PDO
     */
    public static function getInstance(): PDO
    {
        if (empty(self::$instance)) {
            self::$instance = new PDO(
                "mysql:host=" . SettingHelper::getDatabaseEnv(
                    'hostname'
                ) . ";charset=utf8;dbname=" . SettingHelper::getDatabaseEnv('database'),
                SettingHelper::getDatabaseEnv('username'),
                SettingHelper::getDatabaseEnv('password')
            );

            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        return self::$instance;
    }
}
