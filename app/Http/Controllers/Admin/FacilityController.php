<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Facility;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:facilities-list|facilities-create|facilities-edit|facilities-delete', ['only' => ['index','store']]);
         $this->middleware('permission:facilities-create', ['only' => ['create','store']]);
         $this->middleware('permission:facilities-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:facilities-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
       
        $facilities = Facility::all();
        return view('admin.facility.index',compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.facility.create');
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
        $facility = new Facility([
            'name' => $request->get('name'),
        ]);
        $facility->save();
        return redirect()->route('facilities.index')->with('success', 'Facility Added Successfully!');
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
        $facility = Facility::find($id);
        return view('admin.facility.edit',compact('facility'));
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

        $facility = Facility::find($id);
        $facility->name =  $request->get('name');
        $facility->save();

        return redirect()->route('facilities.index')->with('success', 'Facility updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $education = Facility::find($id);
        $education->delete();
        return redirect()->route('facilities.index')->with('success', 'Facility deleted!');
    }
}
