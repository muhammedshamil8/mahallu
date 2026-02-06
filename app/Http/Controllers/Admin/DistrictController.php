<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\District;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:districts-list|districts-create|districts-edit|districts-delete', ['only' => ['index','store']]);
         $this->middleware('permission:districts-create', ['only' => ['create','store']]);
         $this->middleware('permission:districts-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:districts-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $districts = District::all();
        return view('admin.district.index',compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.district.create');
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
        $district = new District([
            'name' => $request->get('name'),
        ]);
        $district->save();
        return redirect()->route('districts.index')->with('success', 'District Added Successfully!');
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
        $district = District::find($id);
        return view('admin.district.edit',compact('district'));
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

        $district = District::find($id);
        $district->name =  $request->get('name');
        $district->save();

        return redirect()->route('districts.index')->with('success', 'District updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $district = District::find($id);
        $district->delete();
        return redirect()->route('districts.index')->with('success', 'District deleted!');
    }
}
