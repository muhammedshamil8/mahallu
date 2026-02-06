<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Relation;

class RelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:relations-list|relations-create|relations-edit|relations-delete', ['only' => ['index','store']]);
         $this->middleware('permission:relations-create', ['only' => ['create','store']]);
         $this->middleware('permission:relations-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:relations-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $relations = Relation::all();
        return view('admin.relation.index',compact('relations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.relation.create');
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
        $relation = new Relation([
            'name' => $request->get('name'),
        ]);
        $relation->save();
        return redirect()->route('relations.index')->with('success', 'Relation Added Successfully!');
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
        $relation = Relation::find($id);
        return view('admin.relation.edit',compact('relation'));
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

        $relation = Relation::find($id);
        $relation->name =  $request->get('name');
        $relation->save();

        return redirect()->route('relations.index')->with('success', 'Relation updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $relation = Relation::find($id);
        $relation->delete();
        return redirect()->route('relations.index')->with('success', 'Relation deleted!');
    }
}
