<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 8/30/18
 * Time: 8:09 AM
 */

namespace App\Services;


class BreadcrumbService
{
    public $config;
    public function __construct()
    {
        $this->config = config('breadcrumbs');
    }
    public function get($configs)
    {
        $breadcrumbs = [];
        $parameter = '';
        $configs = explode('.', $configs);
        foreach ($configs as $key=>$config){
            if($key == 0){
                $parameter .=$config;
                continue;
            }
            $parameter .= '.'.$config;
            $arrayConfig = array_get($this->config, $parameter);
            array_push($breadcrumbs,[
               'name' => $arrayConfig['name'],
               'url' => route($arrayConfig['route_name']),
            ]);
        }
       return $breadcrumbs;
    }
}