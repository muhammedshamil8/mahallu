<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Designation;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:designation-list|designation-create|designation-edit|designation-delete', ['only' => ['index','store']]);
         $this->middleware('permission:designation-create', ['only' => ['create','store']]);
         $this->middleware('permission:designation-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:designation-delete', ['only' => ['destroy']]);
    }
    public function index()
    {   

         $designation = Designation::all();
        
         return view('admin.designation.index', compact('designation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.designation.create');
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
            'description'=>'nullable',
        ]);
        $designation = new Designation([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);
        $designation->save();
        return redirect()->route('designation.index')->with('success', 'Designation Added Successfully!');
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
        
        
        $designation = Designation::find($id);
        return view('admin.designation.edit',compact('designation'));

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
                'description'=>'nullable',
            ]);

        $designation = Designation::find($id);
        $designation->name =  $request->get('name');
        $designation->description =  $request->get('description');
        $designation->save();

        return redirect()->route('designation.index')->with('success', 'Designation updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $designation = Designation::find($id);
        $designation->delete();
        return redirect()->route('designation.index')->with('success', 'Designation deleted!');
    }
}
