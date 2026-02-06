<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:jobs-list|jobs-create|jobs-edit|jobs-delete', ['only' => ['index','store']]);
         $this->middleware('permission:jobs-create', ['only' => ['create','store']]);
         $this->middleware('permission:jobs-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:jobs-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $jobs = Job::all();
        return view('admin.job.index',compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.job.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $job = new Job([
            'name' => $request->get('name'),
        ]);
        $job->save();
        return redirect()->route('jobs.index')->with('success', 'Job Added Successfully!');
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
        $job = Job::find($id);
        return view('admin.job.edit',compact('job'));
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
        $request->validate([
                'name'=>'required',
            ]);

        $job = Job::find($id);
        $job->name =  $request->get('name');
        $job->save();

        return redirect()->route('jobs.index')->with('success', 'Job updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted!');
    }
}
