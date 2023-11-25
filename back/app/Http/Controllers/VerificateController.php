<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VerificateController extends Controller
{
    public function form(int $user){
        return view('verification', compact('user'));
    }

    public function verification(Request $request)
    {
        $data = $request->validate([
            'user' => '',
            'code' => '',
            'currentCode' => ''
        ]);

        $user = User::where('id', $data['user'])->get();
        $user = $user[0];
        if($data['code'] === $data['currentCode']){
            $user->update([
                'email_verified_at' => Carbon::now()
            ]);
            session()->forget('code');
            Auth::login($user);
            return redirect()->route('index');
        }

        return back();
    }
}
