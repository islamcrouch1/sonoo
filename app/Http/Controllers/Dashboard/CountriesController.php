<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator');
        $this->middleware('permission:countries-read')->only('index', 'show');
        $this->middleware('permission:countries-create')->only('create', 'store');
        $this->middleware('permission:countries-update')->only('edit', 'update');
        $this->middleware('permission:countries-delete|countries-trash')->only('destroy', 'trashed');
        $this->middleware('permission:countries-restore')->only('restore');
    }


    public function index()
    {
        $countries = Country::whenSearch(request()->search)
            ->latest()
            ->paginate(100);
        return view('Dashboard.countries.index')->with('countries', $countries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => "required|string|max:255|unique:countries",
            'name_en' => "required|string|max:255|unique:countries",
            'code' => "required|string",
            'currency' => "required|string",
            'image' => "required|image",
        ]);

        Image::make($request->image)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('storage/images/countries/' . $request->image->hashName()), 80);

        $country = Country::create([
            'name_ar' => $request['name_ar'],
            'name_en' => $request['name_en'],
            'code' => $request['code'],
            'currency' => $request['currency'],
            'image' => $request->image->hashName(),
        ]);

        alertSuccess('Country created successfully', 'تم اضافة الدولة بنجاح');
        return redirect()->route('countries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($country)
    {
        $country = Country::findOrFail($country);
        return view('Dashboard.countries.edit ')->with('country', $country);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {

        $request->validate([
            'name_ar' => "required|string|max:255|unique:countries,name_ar," . $country->id,
            'name_en' => "required|string|max:255|unique:countries,name_en," . $country->id,
            'code' => "required|string",
            'currency' => "required|string",
            'image' => "nullable|image",
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete('/images/countries/' . $country->image);
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('storage/images/countries/' . $request->image->hashName()), 80);
            $country->update([
                'image' => $request->image->hashName(),
            ]);
        }

        $country->update([
            'name_ar' => $request['name_ar'],
            'name_en' => $request['name_en'],
            'code' => $request['code'],
            'currency' => $request['currency'],
        ]);



        alertSuccess('Country updated successfully', 'تم تعديل الدولة بنجاح');
        return redirect()->route('countries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($country)
    {
        $country = Country::withTrashed()->where('id', $country)->first();
        if ($country->trashed() && auth()->user()->hasPermission('countries-delete')) {
            Storage::disk('public')->delete('/images/countries/' . $country->image);
            $country->forceDelete();
            alertSuccess('country deleted successfully', 'تم حذف الدولة بنجاح');
            return redirect()->route('countries.trashed');
        } elseif (!$country->trashed() && auth()->user()->hasPermission('countries-trash') && checkCountryForTrash($country)) {
            $country->delete();
            alertSuccess('country trashed successfully', 'تم حذف الدولة مؤقتا');
            return redirect()->route('countries.index');
        } else {
            alertError('Sorry, you do not have permission to perform this action, or the country cannot be deleted at the moment', 'نأسف ليس لديك صلاحية للقيام بهذا الإجراء ، أو الدولة لا يمكن حذفها حاليا');
            return redirect()->back();
        }
    }


    public function trashed()
    {
        $countries = Country::onlyTrashed()->paginate(100);
        return view('Dashboard.countries.index', ['countries' => $countries]);
    }

    public function restore($country)
    {
        $country = Country::withTrashed()->where('id', $country)->first()->restore();
        alertSuccess('country restored successfully', 'تم استعادة الدولة بنجاح');
        return redirect()->route('countries.index');
    }
}
