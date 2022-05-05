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

        // Image::make($request->image)->resize(300, null, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save(public_path('storage/images/countries/' . $request->image->hashName()), 80);

        alertSuccess('Settings saved successfully', 'تم حفظ الإعدادات بنجاح');
        return redirect()->route('settings.index');
    }
}
