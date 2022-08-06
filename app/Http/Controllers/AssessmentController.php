<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use App\Models\QuestionOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    public function index()
    {
        $assessment = Assessment::all();

        return view('assessment.index', compact('assessment'));
    }

    public function manage()
    {
        if(Auth::user()->isAdmin == 1){
            $assessment = Assessment::all();

            return view('assessment.manage', compact('assessment'));
        }else{
            abort('404');
        }
    }

    public function add()
    {
        if(Auth::user()->isAdmin == 1){
            return view('assessment.add');
        }else{
            abort('404');
        }
    }

    public function store(Request $request)
    {
        $assessment = new Assessment();
        $assessment->name = $request->name;
        $assessment->description = $request->description;
        $assessment->evaluation_method = $request->evaluation_method;
        $assessment->created_by = Auth::id();
        $assessment->modified_by = Auth::id();
        $assessment->save();

        return redirect('/assessment/manage')->with('success-add', 'Success Add Assessment!');
    }

    public function delete($id)
    {
        $assessment = Assessment::find($id);
        $assessment->delete();


        $assessment_question = AssessmentQuestion::where('assessment_id', $id)->get();
        foreach($assessment_question as $a)
        {
            $question_option = QuestionOptions::where('question_id', $a->id)->get();
            foreach($question_option as $q)
            {
                QuestionOptions::find($q->id)->delete();
            }
            AssessmentQuestion::find($a->id)->delete();
        }

        return redirect()->back()->with('success-delete', 'Success Delete Assessment!');

    }

    public function edit($id)
    {
        if(Auth::user()->isAdmin == 1){
            $assessment = Assessment::find($id);
            $questions = AssessmentQuestion::where('assessment_id', $id)->withCount('options')->get();

            return view('assessment.edit', compact('assessment', 'questions'));
        }else{
            abort('404');
        }
    }

    public function question_store(Request $request)
    {
        
        $question = new AssessmentQuestion();
        $question->assessment_id = $request->assessment_id;
        $question->question = $request->question;
        $question->created_by = Auth::id();
        $question->modified_by = Auth::id();
        $question->save();

        foreach($request->option as $key => $each){
            
            $option = new QuestionOptions();
            $option->question_id = $question->id;
            $option->value = $request->value[$key];
            $option->option = $each;
            $option->created_by = Auth::id();
            $option->modified_by = Auth::id();
            $option->save();
        }

        return redirect()->back()->with('success-add', 'Success Add Question!');
    }

    public function question_delete($id)
    {
        $question_option = QuestionOptions::where('question_id', $id)->get();
        foreach($question_option as $q)
        {
            QuestionOptions::find($q->id)->delete();
        }

        $assessment_question = AssessmentQuestion::find($id);
        $assessment_question->delete();

        return redirect()->back()->with('success-delete', 'Success Delete Question!');
    }

    public function question_edit($id)
    {
        $question = AssessmentQuestion::find($id);
        $question->options = $question->options;

        return $question;
    }

    public function question_update(Request $request)
    {
        return $request->all();
    }
}
