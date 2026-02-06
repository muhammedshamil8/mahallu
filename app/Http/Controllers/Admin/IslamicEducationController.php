<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IslamicEducation;

class IslamicEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:islamic_educations-list|islamic_educations-create|islamic_educations-edit|islamic_educations-delete', ['only' => ['index','store']]);
         $this->middleware('permission:islamic_educations-create', ['only' => ['create','store']]);
         $this->middleware('permission:islamic_educations-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:islamic_educations-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $educations = IslamicEducation::all();
        return view('admin.islamic_education.index',compact('educations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.islamic_education.create');
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
        $education = new IslamicEducation([
            'name' => $request->get('name'),
        ]);
        $education->save();
        return redirect()->route('islamic_educations.index')->with('success', 'Islamic Education Added Successfully!');
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
        $education = IslamicEducation::find($id);
        return view('admin.islamic_education.edit',compact('education'));
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

        $education = IslamicEducation::find($id);
        $education->name =  $request->get('name');
        $education->save();

        return redirect()->route('islamic_educations.index')->with('success', 'Islamic Education updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $education = IslamicEducation::find($id);
        $education->delete();
        return redirect()->route('islamic_educations.index')->with('success', 'Islamic Education deleted!');
    }
}
