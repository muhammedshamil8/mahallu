<?php

namespace App\Http\Controllers\Student;

use Auth;
use App\Exam;
use App\Test;
use App\TestAnswer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $exam_id = Crypt::decryptString($request->exam_id);
        $results = Test::all()->where('exam_id', '=', $exam_id);

        /*if (!Auth::user()->isAdmin()) {
            $results = $results->where('user_id', '=', Auth::id());
        }*/

        return view('student.results.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($enc_id)
    {
        $id = Crypt::decryptString($enc_id);
        $test = Test::find($id);

        if ($test) {
            $results = TestAnswer::where('test_id', $id)
            ->with('question')
            ->with('question.options')
            ->get();

            $exam_id = Test::where('id',$id)->value('exam_id');
            $topic_id = Exam::where('id',$exam_id)->value('topic_id');
        }

        return view('student.results.show', compact('test', 'results','exam_id','topic_id'));
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
