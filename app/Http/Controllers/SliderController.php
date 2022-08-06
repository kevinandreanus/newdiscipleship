<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class SliderController extends Controller
{
    public function edit()
    {
        $slider = Slider::all();

        return view('slider.index', compact('slider'));
    }

    public function store(Request $request)
    {
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->caption = $request->caption;
        $slider->link = $request->link;

        $image = $request->file('image');
        $name = $image->hashName();

        $image_resize = Image::make($image->getRealPath());              
        $image_resize->resize(500, 500);
        $image_resize->save(public_path('storage/slider/'.time().$name));

        $slider->image_url = 'storage/slider/'.time().$name;

        $slider->created_by = Auth::id();
        $slider->modified_by = Auth::id();

        $slider->save();

        return redirect()->back()->with('success-add', 'Success Add Slider!');
    }

    public function delete($id)
    {
        $slider = Slider::find($id);
        $slider->delete();

        return redirect()->back()->with('success-delete', 'Success Delete Slider!');
    }
}
