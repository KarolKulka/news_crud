<?php
declare(strict_types=1);

namespace App\Helper;

use App\Interface\ToArrayInterface;

/**
 * Class UrlHelper
 * @package App\Helper
 */
class UrlHelper
{
    /**
     * Return base url from set in .env file
     *
     * @return string
     */
    public static function getBaseUrl(): string
    {
        return SettingHelper::getBaseEnv('url');
    }

    /**
     * Return proper url based on given param values
     *
     * @param array|ToArrayInterface $params
     * @return string
     */
    public static function getSiteUrl(array|ToArrayInterface $params): string
    {
        $getParamsArray = $params;

        if ($getParamsArray instanceof ToArrayInterface){
            $getParamsArray = $getParamsArray->toArray();
        }

        $getParamsArray = self::prepareGetParams($getParamsArray);

        $getParams = http_build_query($getParamsArray);

        return self::getBaseUrl().(!empty($getParams) ? '?'.$getParams : '');
    }

    /**
     * Checks if any of the given param is empty and unset it
     *
     * @param array $getParams
     * @return array
     */
    private static function prepareGetParams(array $getParams): array
    {
        foreach ($getParams as $key => $param){
            if (empty($param)){
                unset($getParams[$key]);
            }
        }

        return $getParams;
    }

}
