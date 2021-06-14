<?php
declare(strict_types=1);

namespace App\Helper;

use App\Controller\BaseController;

/**
 * Class RequestHelper
 * @package App\Helper
 */
class RequestHelper
{
    /**
     * Return value of controller ['cl'] key from $_GET array
     *
     * @return string
     */
    public static function getRequestController(): string
    {
        return SecurityHelper::sanitizeVar($_GET['cl']) ?? '';
    }

    /**
     * Return value of action ['action'] key from $_GET array
     *
     * @return string
     */
    public static function getRequestAction(): string
    {
        return SecurityHelper::sanitizeVar($_GET['action']) ?? '';
    }

    /**
     * Return value of method ['method'] key from $_GET array
     *
     * @return string
     */
    public static function getRequestMethod(): string
    {
        return SecurityHelper::sanitizeVar($_GET['method']) ?? '';
    }

    /**
     * Check if given key exists in $_GET array and return it
     *
     * @param string $param
     * @return string|null
     */
    public static function findRequestGetParam(string $param): ?string
    {
        if (isset($_GET[$param])){
            return SecurityHelper::sanitizeVar($_GET[$param]);
        }

        return null;
    }

    /**
     * Translates value of method param in $_GET array to proper function name. Example list-news -> listNews
     *
     * @return string
     */
    public static function getRequestControllerMethod(): string
    {
        $method = self::getRequestMethod();
        $methodExploded = explode('-', $method);

        $output = '';
        foreach($methodExploded as $key => $methodPart){
            if (0 === $key){
                $output = $methodPart;
                continue;
            }

            $output .= ucfirst($methodPart);
        }

        return $output;
    }

    /**
     * Check if method passed $_GET array exists in controller passed as parameter
     *
     * @param BaseController $controller
     * @return bool
     */
    public static function verifyControllerMethod(BaseController $controller): bool
    {
        return method_exists($controller, self::getRequestControllerMethod());
    }

    /**
     * Check if current request method is POST
     *
     * @return bool
     */
    public static function isPostRequest(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Return $_POST array
     *
     * @return array
     */
    public static function getPost(): array
    {
        return $_POST;
    }

    /**
     * Check if given key exists in $_POST array and return it
     *
     * @param string $key
     * @return string|null
     */
    public static function getPostValue(string $key): ?string
    {
        if (isset(self::getPost()[$key])){
            return SecurityHelper::sanitizeVar(self::getPost()[$key]);
        }

        return null;
    }
}
