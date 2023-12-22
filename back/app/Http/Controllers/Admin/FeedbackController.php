<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class FeedbackController extends Controller
{
    public function index(){
        $feedbacks = DB::table('feedback')
            ->leftJoin('users', 'users.id', '=', 'feedback.parent_id')
            ->select('feedback.id','feedback.stars', 'feedback.created_at', 'users.name', 'users.surname')
            ->get();
        return view('admin.feedback.index', compact('feedbacks'));
    }

    public function show(Feedback $feedback){
        $feedback = DB::table('feedback')
            ->leftJoin('users', 'users.id', '=', 'feedback.parent_id')
            ->select('feedback.stars', 'feedback.comment', 'users.name', 'users.surname', 'users.profile_photo', 'users.email', 'users.phone_number')
            ->get();
        return view('admin.feedback.show', compact('feedback'));
    }

}
