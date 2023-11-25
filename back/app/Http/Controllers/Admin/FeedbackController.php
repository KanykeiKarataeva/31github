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

    public function delete(Feedback $feedback){
        $feedback->delete();
        $message = Lang::get('lang.delete_answer_feedback');
        return redirect()->route('admin.feedback.index')->with('status', $message);
    }

    public function show(Feedback $feedback){
        $feedback = DB::table('feedback')
            ->leftJoin('users', 'users.id', '=', 'feedback.parent_id')
            ->where('feedback.id', $feedback->id)
            ->select('feedback.stars', 'feedback.comment', 'users.name', 'users.surname', 'users.profile_photo', 'users.email', 'users.phone_number')
            ->get();
        return view('admin.feedback.show', compact('feedback'));
    }

}
