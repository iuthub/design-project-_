<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\SettingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public $setting;
    public function __construct(SettingRepository $settingRepository)
    {
        $this->setting = $settingRepository;
    }

    public function edit()
    {
        $data['settings'] = $this->setting->getAll();
        return view('backend.settings.edit',$data);
    }

    public function update(Request $request)
    {
        $parameters = $request->except('_token','_method');
        if($this->setting->update($parameters)){
            return redirect()->route('admin.settings')->with('success',__('Setting has been updated successfully.'));
        }
        return redirect()->back()->withInput()->with('error',__('Failed to update.'));
    }
}
