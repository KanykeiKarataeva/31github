<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class FeedbackController extends Controller
{
    public function create(Request $request){
        $data = $request->validate([
            'parent_id' => 'required',
            'stars' => 'required',
            'comment' => 'required'
        ]);
        Feedback::create([
            'parent_id' => $data['parent_id'],
            'stars' => $data['stars'],
            'comment' => $data['comment']
        ]);
        $message = Lang::get('lang.feedback_accepted_msg');
        return redirect()->route('index')->with('status',$message);
    }
}
