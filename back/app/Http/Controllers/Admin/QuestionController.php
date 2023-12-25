<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateResumeQuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class QuestionController extends Controller
{
    public function index(){
        $questions = Question::all();
        return view('admin.resume.question.index', compact('questions'));
    }

    public function create(Request $request){
        $data = $request->validate([
            'question' => 'required|string'
        ]);

        $question = Question::create([
           'question' => $data['question']
        ]);

        return response()->json($question);
    }


    public function delete(Question $question){
        $question->delete();
        $message = Lang::get('lang.delete_answer_questions');
        return redirect()->route('admin.resume.question.index')->with('status', $message);
    }

}
