<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Committe;
use App\CommitteeMember;

class CommitteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:committe-list|committe-create|committe-edit|committe-delete', ['only' => ['index','store']]);
         $this->middleware('permission:committe-create', ['only' => ['create','store']]);
         $this->middleware('permission:committe-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:committe-delete', ['only' => ['destroy']]);
    }
    public function index()
    {   
        $committe = Committe::all();
        return view('admin.commite.index', compact('committe'));
       // return view('admin.commite.add_member');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.commite.create');
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
            //'description'=>'required',
        ]);
        $committe = new Committe([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);
        $committe->save();
        return redirect()->route('committe.index')->with('success', 'Committe Added Successfully!');
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
        
        $committe = Committe::find($id);
        $members = CommitteeMember::where('committee_id',$id)->get();
        return view('admin.commite.edit',compact('committe','members'));
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
                //'description'=>'nullable',
            ]);

        $committe = Committe::find($id);
        $committe->name =  $request->get('name');
        $committe->description =  $request->get('description');
        $committe->save();

        return redirect()->route('committe.index')->with('success', 'Committe updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $committe = Committe::find($id);
        $committe->delete();
        return redirect()->route('committe.index')->with('success', 'Committe deleted!');
    }

   public function member_list()
    {   

         return view('admin.commite.add_member');
    }
}
