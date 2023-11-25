<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\UpdateProfileRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(User $user){
        return view('admin.profile', compact('user'));
    }

    public function update(UpdateProfileRequest $request, User $user){
        $data = $request->validated();
        DB::beginTransaction();
        $passport_back = $user->passport_back;
        $passport_front = $user->passport_front;
        $profile_photo = $user->profile_photo;
        if(array_key_exists('passport_front', $data)){
            $image = Storage::disk('public')->put('passports', $data['passport_front']);
            $passport_front = "storage/".$image;
        }
        if(array_key_exists('passport_back', $data)){
            $image = Storage::disk('public')->put('passports', $data['passport_back']);
            $passport_back = "storage/".$image;
        }
        if($request->hasFile('profile_photo')){
            $profile_photo = Storage::disk('public')->put('profile', $data['profile_photo']);
            $profile_photo = "storage/".$profile_photo;
        }
        $user->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'profile_photo' => $profile_photo,
            'passport_back' => $passport_back,
            'passport_front' => $passport_front
        ]);
        DB::commit();
        return redirect('admin/profile/'.$user->id)->with('status','Ваши данные были обновлены');
    }
}
