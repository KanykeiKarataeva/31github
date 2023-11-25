<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\MainGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class MainGalleryController extends Controller
{
    public function index(){
        $galleries = MainGallery::all();
        return view('admin.mainGallery.index', compact('galleries'));
    }

    public function create(Request $request){
        if($request->has('images')){
            foreach ($request->file('images') as $image) {
                $imageName = Storage::disk('public')->put('main_gallery', $image);
                $imageName = "storage/".$imageName;
                MainGallery::create([
                    'image'=>$imageName,
                    'video'=>null
                ]);
            }
        }
        if($request->has('videos')){
            foreach ($request->file('videos') as $video) {
                $videoName = Storage::disk('public')->put('main_gallery', $video);
                $videoName = "storage/".$videoName;
                MainGallery::create([
                    'image'=>null,
                    'video'=>$videoName
                ]);
            }
        }
        return redirect()->route('admin.mainGallery.index')->with('status','Photos and videos added to the gallery');
    }

    public function delete(MainGallery $gallery){
        $gallery->delete();
        $message = Lang::get('lang.delete_answer');
        return redirect()->route('admin.mainGallery.index')->with('status', $message);
    }
}
