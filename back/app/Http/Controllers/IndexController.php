<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Feedback;
use App\Models\MainGallery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        if($request->user){
            $user = User::where('id', $request->user)->get();
            if(count($user)){
                Auth::login($user[0]);
            }

        }
        $user = auth()->user();
        $galleries = MainGallery::all();
        $feedbacks = DB::table('feedback')
            ->leftJoin('users', 'users.id', '=', 'feedback.parent_id')
            ->select('feedback.stars', 'feedback.comment', 'users.name', 'users.surname', 'users.profile_photo')
            ->get();
        if($user){
            if($user->role === 'ROLE_ADMIN' or $user->role === 'ROLE_TEACHER' or $user->role === 'ROLE_PARENT' or $user->role === 'ROLE_USER'){
                $children = Child::where('parent_id', $user->id)->get();
                return view('index', compact('children', 'feedbacks'));
            }
        }
        return view('index',compact('galleries', 'feedbacks'));
    }
}
