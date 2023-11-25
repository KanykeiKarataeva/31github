<?php

namespace App\Http\Controllers;

use App\Jobs\SendCodeQueue;
use App\Mail\SendCode;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function form(){
        return view('register');
    }
    public function register(Request $request){
        $data = $request->validate([
            'name'=>'required|string',
            'surname'=>'required|string',
            'address'=>'required',
            'phone_number'=>'required',
            'email'=>'required|email|max:255|unique:users,email,',
            'password'=>'required',
            'passport_front'=>'',
            'passport_back'=>''
        ]);
        $passport_front = null;
        $passport_back = null;
        if(array_key_exists('passport_front',$data)){
            $passport_front = Storage::disk('public')->put('passports', $data['passport_front']);
            $passport_front = "storage/".$passport_front;
        }
        if(array_key_exists('passport_back',$data)){
            $passport_back = Storage::disk('public')->put('passports',$data['passport_back']);
            $passport_back = "storage/".$passport_back;
        }

        $data['password'] = Hash::make($data['password']);

        $user = User::create([
            'name'=>$data['name'],
            'surname'=>$data['surname'],
            'address'=>$data['address'],
            'phone_number'=>$data['phone_number'],
            'email'=>$data['email'],
            'password'=>$data['password'],
            'passport_front'=>$passport_front,
            'passport_back'=>$passport_back
        ]);

        $code = random_int(100000, 999999);
        Mail::to($user->email)->send(new SendCode($code));
        Session::put('code', $code);
        return redirect()->route('verification.form', $user->id);
    }
}
