<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Child;
use App\Models\Question;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VacancyController extends Controller
{
    public function index(){
        $questions = Question::all();
        $user = auth()->user();
        $children = null;
        if($user){
            if($user->role === 'ROLE_ADMIN' or $user->role === 'ROLE_TEACHER' or $user->role === 'ROLE_PARENT'){
                $children = Child::where('parent_id', $user->id)->get();
                return view('user.vacancy', compact('children', 'questions'));
            }
            return view('user.vacancy', compact('questions'));
        }
        return view('user.vacancy', compact('questions'));
    }

    public function save(Request $request){
        $data = $request->validate([
            'full_name' => 'required|string',
            'phone_number' => 'required|string',
            'resume' => '',
            'answers'=>'',
        ]);
        $file = Storage::disk('public')->put('userResumes', $data['resume']);
        $file = "storage/".$file;

        $resume = Resume::create([
           'full_name' => $data['full_name'],
           'phone_number' => $data['phone_number'],
           'resume' => $file
        ]);
        $answers = json_decode($data['answers']);
        foreach ($answers as $key => $item)
        {
            Answer::create([
                'answers' => $item,
                'resume_id' => $resume->id,
                'question_id' => $key
            ]);
        }
        return response(['message' => 'success']);
    }

}
