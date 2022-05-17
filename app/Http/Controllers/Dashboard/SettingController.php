<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('dashboard.settings.index', compact('settings'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'max_price' => "required|numeric",
            'tax' => "required|numeric",
        ]);


        $setting = Setting::where('type', 'max_price')->first();
        if ($setting == null) {
            Setting::create([
                'type' => 'max_price',
                'value' => $request['max_price'],
            ]);
        } else {
            $setting->update([
                'value' => $request['max_price'],
            ]);
        }

        $setting = Setting::where('type', 'tax')->first();
        if ($setting == null) {
            Setting::create([
                'type' => 'tax',
                'value' => $request['tax'],
            ]);
        } else {
            $setting->update([
                'value' => $request['tax'],
            ]);
        }


        $setting = Setting::where('type', 'commission')->first();
        if ($setting == null) {
            Setting::create([
                'type' => 'commission',
                'value' => $request['commission'],
            ]);
        } else {
            $setting->update([
                'value' => $request['commission'],
            ]);
        }


        $setting = Setting::where('type', 'affiliate_limit')->first();
        if ($setting == null) {
            Setting::create([
                'type' => 'affiliate_limit',
                'value' => $request['affiliate_limit'],
            ]);
        } else {
            $setting->update([
                'value' => $request['affiliate_limit'],
            ]);
        }


        $setting = Setting::where('type', 'vendor_limit')->first();
        if ($setting == null) {
            Setting::create([
                'type' => 'vendor_limit',
                'value' => $request['vendor_limit'],
            ]);
        } else {
            $setting->update([
                'value' => $request['vendor_limit'],
            ]);
        }

        $setting = Setting::where('type', 'mandatory_affiliate')->first();
        if ($setting == null) {
            Setting::create([
                'type' => 'mandatory_affiliate',
                'value' => $request['mandatory_affiliate'],
            ]);
        } else {
            $setting->update([
                'value' => $request['mandatory_affiliate'],
            ]);
        }


        $setting = Setting::where('type', 'mandatory_vendor')->first();
        if ($setting == null) {
            Setting::create([
                'type' => 'mandatory_vendor',
                'value' => $request['mandatory_vendor'],
            ]);
        } else {
            $setting->update([
                'value' => $request['mandatory_vendor'],
            ]);
        }



        // Image::make($request->image)->resize(300, null, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save(public_path('storage/images/countries/' . $request->image->hashName()), 80);

        alertSuccess('Settings saved successfully', 'تم حفظ الإعدادات بنجاح');
        return redirect()->route('settings.index');
    }
}
