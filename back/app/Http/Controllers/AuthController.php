<?php

namespace App\Http\Controllers;

use App\Mail\SendCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function form(){
        return view('login');
    }

    public function userAuth(Request $request){
        $user = User::where('email', $request->email)->get();
        if(count($user)){
            $user = $user[0];

            if(Hash::check($request->password, $user->password)){
                if($user->email_verified_at){
                    Auth::login($user);
                    return redirect()->route('index');
                }
                $code = random_int(100000, 999999);
                Mail::to($user->email)->send(new SendCode($code));
                Session::put('code', $code);
                return redirect()->route('verification.form', $user->id);

            }
            else{
                return redirect()
                    ->back()
                    ->with(['errorWithPassword' => 'incorrect password', 'email' => $request->email]);
            }
        }

        return redirect()
            ->back()
            ->with(['errorWithEmail' => 'user not found', 'email' => $request->email]);
    }

}
