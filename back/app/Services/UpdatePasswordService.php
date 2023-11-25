<?php

namespace App\Services;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordService
{
    public function updatePassword(Request $request):Response
    {
        try {
            DB::beginTransaction();

            $data = $request->validate([
                'email' => '',
                'password' =>''
            ]);
            $user = User::where('email', $data['email'])->get();
            $user = $user[0];
            $data['password'] = Hash::make($data['password']);

            $user->update([
                'password' => $data['password']
            ]);

            DB::commit();
            return response(['message' => 'Password updated'])->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
        }
        catch (\Exception $e){
            DB::rollBack();
            return response(['message' => 'some thing wrong'])->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
        }
    }
}
