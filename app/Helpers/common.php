<?php


use App\Repositories\SettingInterface;
use Illuminate\Support\Facades\Cookie;

define('ITEM_PER_PAGE', 15);

if (!function_exists('get_name_for_comment_form')) {
    function get_name_for_comment_form()
    {
        return auth()->check() ? auth()->user()->name : Cookie::get('author_name',null);
    }
}

if (!function_exists('get_email_for_comment_form')) {
    function get_email_for_comment_form()
    {
        return auth()->check() ? auth()->user()->email : Cookie::get('author_email',null);
    }
}
if (!function_exists('settings')) {
    function settings($keys)
    {
        $settingRepository = app(SettingInterface::class);
        return $settingRepository->getBySlug($keys);
    }
}