<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 8/30/18
 * Time: 8:09 AM
 */

namespace App\Services;


use Illuminate\Http\Request;

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
            if(in_array($config,['edit','show'])){
                $route = route($arrayConfig['route_name'],request()->segment(3));
            }else{
                $route = route($arrayConfig['route_name']);
            }

            array_push($breadcrumbs,[
               'name' => $arrayConfig['name'],
               'url' => $route,
            ]);
        }
       return $breadcrumbs;
    }
}