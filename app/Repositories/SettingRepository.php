<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 8/29/18
 * Time: 7:34 PM
 */

namespace App\Repositories;


use App\Models\Author;
use App\Models\Setting;

class SettingRepository implements SettingInterface
{
    public $model;

    public function __construct(Setting $setting)
    {
        $this->model = $setting;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function update($parameters)
    {
        foreach ($parameters as $slug => $value) {
            $this->model->updateOrCreate(['slug' => $slug], ['value' => $value]);
        }
        cache()->forget('settings');
        cache()->forever('settings', $parameters);
        return true;
    }

    public function getBySlug($slugs)
    {
        if (cache()->has('settings')) {
            $settings = cache()->get('settings');
            if (is_array($slugs)) {
                return array_only($settings, $slugs);
            } else {
                return isset($settings[$slugs]) ? $settings[$slugs] : null;
            }
        }

        if (is_array($slugs)) {
            return $settings = $this->model->whereIn('slug', $slugs)->pluck('slug', 'value')->toArray();
        } else {
            return $settings = $this->model->where('slug', $slugs)->value('value');
        }
    }
}
