<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class SlidesController extends Controller
{
    public function index()
    {
        $slides = Slide::whenSearch(request()->search)
            ->paginate(100);
        return view('Dashboard.slides.index')->with('slides', $slides);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.slides.create');
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
            'slider_id' => "required|numeric",
            'url' => "required|string",
            'image' => "required|image",
        ]);

        Image::make($request->image)->resize(2500, 625, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('storage/images/slides/' . $request->image->hashName()), 80);

        $slide = Slide::create([
            'slider_id' => $request['slider_id'],
            'url' => $request['url'],
            'image' => $request->image->hashName(),
        ]);

        alertSuccess('slide created successfully', 'تم إضافة الصورة بنجاح');
        return redirect()->route('slides.index');
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
    public function edit($slide)
    {
        $slide = Slide::find($slide);
        return view('Dashboard.slides.edit ')->with('slide', $slide);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, slide $slide)
    {
        $request->validate([
            'slider_id' => "string",
            'url' => "string",
            'image' => "image",
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete('/images/slides/' . $slide->image);
            Image::make($request->image)->resize(2500, 625, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('storage/images/slides/' . $request->image->hashName()), 80);
            $slide->update([
                'image' => $request->image->hashName(),
            ]);
        }

        $slide->update([
            'slider_id' => $request['slider_id'],
            'url' => $request['url'],
        ]);

        alertSuccess('slide updated successfully', 'تم تحديث الصورة بنجاح');
        return redirect()->route('slides.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slide)
    {
        $slide = Slide::withTrashed()->where('id', $slide)->first();
        if ($slide->trashed() && auth()->user()->hasPermission('slides-delete')) {
            Storage::disk('public')->delete('/images/slides/' . $slide->image);
            $slide->forceDelete();
            alertSuccess('slide deleted successfully', 'تم حذف الصورة بنجاح');
            return redirect()->route('slides.trashed');
        } elseif (!$slide->trashed() && auth()->user()->hasPermission('slides-trash')) {
            $slide->delete();
            alertSuccess('slide trashed successfully', 'تم حذف الصورة مؤقتا');
            return redirect()->route('slides.index');
        } else {
            alertError('Sorry, you do not have permission to perform this action, or the slide cannot be deleted at the moment', 'نأسف ليس لديك صلاحية للقيام بهذا الإجراء ، أو الصورة لا يمكن حذفها حاليا');
            return redirect()->back();
        }
    }


    public function trashed()
    {
        $slides = Slide::onlyTrashed()->paginate(100);
        return view('Dashboard.slides.index', ['slides' => $slides]);
    }

    public function restore($slide)
    {
        $slide = Slide::withTrashed()->where('id', $slide)->first()->restore();
        alertSuccess('slide restored successfully', 'تم استعادة الصورة بنجاح');
        return redirect()->route('slides.index');
    }
}
