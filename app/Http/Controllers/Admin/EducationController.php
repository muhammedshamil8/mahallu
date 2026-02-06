<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Education;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:educations-list|educations-create|educations-edit|educations-delete', ['only' => ['index','store']]);
         $this->middleware('permission:educations-create', ['only' => ['create','store']]);
         $this->middleware('permission:educations-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:educations-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $educations = Education::all();
        return view('admin.education.index',compact('educations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.education.create');
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
        $education = new Education([
            'name' => $request->get('name'),
        ]);
        $education->save();
        return redirect()->route('educations.index')->with('success', 'Education Added Successfully!');
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
    {dd($id);
        $education = Education::find($id);
        return view('admin.education.edit',compact('education'));
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

        $education = Education::find($id);
        $education->name =  $request->get('name');
        $education->save();

        return redirect()->route('educations.index')->with('success', 'Education updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $education = Education::find($id);
        $education->delete();
        return redirect()->route('educations.index')->with('success', 'Education deleted!');
    }
}
