<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:classes-list|classes-create|classes-edit|classes-delete', ['only' => ['index','store']]);
         $this->middleware('permission:classes-create', ['only' => ['create','store']]);
         $this->middleware('permission:classes-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:classes-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $classes = Course::all();
        return view('admin.class.index',compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.class.create');
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
            'description'=>'nullable|string',
        ]);
        $class = new Course([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);
        $class->save();
        return redirect()->route('classes.index')->with('success', 'Class Added Successfully!');
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
        $class = Course::find($id);
        return view('admin.class.edit',compact('class'));
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
            'description'=>'nullable|string',
            ]);

        $class = Course::find($id);
        $class->name =  $request->get('name');
        $class->description =  $request->get('description');
        $class->save();

        return redirect()->route('classes.index')->with('success', 'Class updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = Course::find($id);
        $class->delete();
        return redirect()->route('classes.index')->with('success', 'Class deleted successfully!');
    }
}
