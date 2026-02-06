<?php

namespace App\Http\Controllers\Student;

use Auth;
use App\Exam;
use App\Test;
use App\TestAnswer;
use App\Question;
use App\QuestionsOption;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_name = Auth::user()->name;
        $exams = Exam::where('course_id', '=', Auth::user()->course_id)->get();
        return view('student.tests.index', compact('user_name','exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $exam_id = Crypt::decryptString($request->exam_id);
        $user = Test::where([
            ['user_id', '=', Auth::id()],
            ['exam_id', '=', $exam_id],
        ])->first();
        //if ($user === null) {
            $user_name = Auth::user()->name;
            $exam = Exam::where('id', '=', $exam_id)->first();
            $questions = Question::inRandomOrder()->limit(10)->where('exam_id',$exam->id)->get();
            foreach ($questions as &$question) {
                $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
            }

            return view('student.tests.create', compact('user_name','questions','exam'));
        /*}else{
            return redirect('student')->with('error', 'You have already attended the exam!');
        }*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = 0;
        $exam_id = $request->input('exam_id');

        $test = Test::create([
            'user_id' => Auth::id(),
            'result'  => $result,
            'exam_id' => $exam_id,
        ]);

        foreach ($request->input('questions', []) as $key => $question) {
            $status = 0;

            if ($request->input('answers.'.$question) != null
                && QuestionsOption::find($request->input('answers.'.$question))->correct
            ) {
                $status = 1;
            $result++;
        }
        TestAnswer::create([
            'user_id'     => Auth::id(),
            'test_id'     => $test->id,
            'question_id' => $question,
            'option_id'   => $request->input('answers.'.$question),
            'correct'     => $status,
        ]);
    }

    $test->update(['result' => $result]);
    return redirect()->route('results.show',[Crypt::encryptString($test->id)])->with('success', 'Exam Completed Successfully!');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
