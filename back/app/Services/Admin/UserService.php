<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function store(StoreRequest $request):Response
    {
        $data = $request->validated();
        $passport_front = null;
        $passport_back = null;
        $profile_photo = null;
        if(array_key_exists('passport_front', $data)){
            $image = Storage::disk('public')->put('passports', $data['passport_front']);
            $passport_front = "storage/".$image;
        }
        if(array_key_exists('passport_back', $data)){
            $image = Storage::disk('public')->put('passports', $data['passport_back']);
            $passport_back = "storage/".$image;
        }
        if(array_key_exists('profile_photo', $data)){
            $profile_photo = Storage::disk('public')->put('profilePhotos', $data['profile_photo']);
            $profile_photo = "storage/".$profile_photo;
        }
        $data['password'] = Hash::make($data['password']);

        $user = User::create([
            'name'=>$data['name'],
            'surname'=>$data['surname'],
            'address'=>$data['address'],
            'phone_number'=>$data['phone_number'],
            'email'=>$data['email'],
            'password'=>$data['password'],
            'role' => $data['role'],
            'profile_photo'=>$profile_photo,
            'passport_front'=>$passport_front,
            'passport_back'=>$passport_back
        ]);
        return response($user);
    }

    public function update(UpdateUserRequest $request, User $user){
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
        if(array_key_exists('profile_photo', $data)){
            $profile_photo = Storage::disk('public')->put('profilePhotos', $data['profile_photo']);
            $profile_photo = "storage/".$profile_photo;
        }
        $user->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'role' => $data['role'],
            'profile_photo' => $profile_photo,
            'passport_back' => $passport_back,
            'passport_front' => $passport_front
        ]);
        DB::commit();
        return redirect()->route('admin.user.index')->with('status','User data is Updated');
    }

}
