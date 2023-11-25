<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateChildrenRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\Child;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ChildrenController extends Controller
{
    public function index(Child $child){
        $galleries = DB::table('galleries')
            ->where('galleries.group_id', $child->group_id)
            ->select('galleries.id', 'galleries.image', 'galleries.video', 'galleries.info', 'galleries.created_at', 'galleries.group_id')
            ->orderBy('galleries.created_at','desc')
            ->get();
        if($galleries && $galleries->count()){
            $created_at_dates = DB::table('galleries')
                ->where('group_id', $galleries[0]->group_id)
                ->distinct()
                ->orderBy('created_at', 'desc')
                ->pluck('created_at');
            $count = [];
            $index = 0;
            foreach ($created_at_dates as $created_at_date){
                $i = 0;
                foreach ($galleries as $gallery){
                    if ($created_at_date === $gallery->created_at){
                        $i++;
                    }
                }
                $count[$index] = $i;
                $index++;
            }
        }
        else{
            $galleries = null;
            $created_at_dates = null;
            $count = null;
        }

        $user = auth()->user();
        $children = null;
        if($user){
            if($user->role === 'ROLE_ADMIN' or $user->role === 'ROLE_TEACHER' or $user->role === 'ROLE_PARENT'){
                $children = Child::where('parent_id', $user->id)->get();
                return view('user.children', compact('children', 'child', 'galleries', 'created_at_dates',  'count'));
            }
            return view('user.children',compact('child', 'galleries', 'created_at_dates',  'count'));
        }
        return view('user.children', compact('child', 'galleries', 'created_at_dates',  'count'));
    }

    public function update(UpdateChildrenRequest $request, Child $child){
        $data = $request->validated();
        DB::beginTransaction();
        $photo = $child->photo;
        $birth_certificate = $child->birth_certificate;
        $med_certificate = $child->med_certificate;
        $med_disability = $child->med_disability;

        if(array_key_exists('photo', $data)){
            $image = Storage::disk('public')->put('childImages/photos', $data['photo']);
            $photo = "storage/".$image;
        }
        if(array_key_exists('birth_certificate', $data)){
            $image = Storage::disk('public')->put('childImages/birthCertificates', $data['birth_certificate']);
            $birth_certificate = "storage/".$image;
        }
        if(array_key_exists('med_certificate', $data)){
            $image = Storage::disk('public')->put('childImages/medCertificates', $data['med_certificate']);
            $med_certificate = "storage/".$image;
        }
        if(array_key_exists('med_disability', $data)){
            $image = Storage::disk('public')->put('childImages/meDisabilities', $data['med_disability']);
            $med_disability = "storage/".$image;
        }
        $child->update([
            'photo' => $photo,
            'birth_certificate' => $birth_certificate,
            'med_certificate' => $med_certificate,
            'med_disability' => $med_disability,
        ]);
        DB::commit();
        return redirect('/main/children/'.$child->id)->with('status','Данные вашего ребенка были обновлены');
    }

}
