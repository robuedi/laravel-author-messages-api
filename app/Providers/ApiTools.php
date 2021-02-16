<?php


namespace App\Providers;


trait ApiTools
{
    private static $api_version = null;

    public function getApiVersion()
    {
        if(self::$api_version === null)
        {
            $request = explode('/', request()->route()->getPrefix());
            self::$api_version = isset($request[0])&&isset($request[1]) ? $request[0].'/'.$request[1] : '';
        }

        return self::$api_version;
    }

}
