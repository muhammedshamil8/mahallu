<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Relegion;

class RelegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:relegion-list|relegion-create|relegion-edit|relegion-delete', ['only' => ['index','store']]);
         $this->middleware('permission:relegion-create', ['only' => ['create','store']]);
         $this->middleware('permission:relegion-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:relegion-delete', ['only' => ['destroy']]);
    }
    public function index()
    {   
        $relegion = Relegion::all();
        return view('admin.relegion.index',compact('relegion'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.relegion.create');
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
        $relegion = new Relegion([
            'name' => $request->get('name'),
        ]);
        $relegion->save();
        return redirect()->route('relegion.index')->with('success', 'Relegion Added Successfully!');
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
        $relegion = Relegion::find($id);
        return view('admin.relegion.edit',compact('relegion'));
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

        $relegion = Relegion::find($id);
        $relegion->name =  $request->get('name');
        $relegion->save();

        return redirect()->route('relegion.index')->with('success', 'Relegion updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $relegion = Relegion::find($id);
         $relegion->delete();
        return redirect()->route('relegion.index')->with('success', 'Relegion deleted!');
    }
}
