<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Help;

class HelpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:helps-list|helps-create|helps-edit|helps-delete', ['only' => ['index','store']]);
         $this->middleware('permission:helps-create', ['only' => ['create','store']]);
         $this->middleware('permission:helps-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:helps-delete', ['only' => ['destroy']]);
    }
    public function index()
    {   

         $helps = Help::all();
        
         return view('admin.help.index', compact('helps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.help.create');
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
        $help = new Help([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);
        $help->save();
        return redirect()->route('helps.index')->with('success', 'Help Added Successfully!');
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
        
        
        $help = Help::find($id);
        return view('admin.help.edit',compact('help'));

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

        $help = Help::find($id);
        $help->name =  $request->get('name');
        $help->description =  $request->get('description');
        $help->save();

        return redirect()->route('helps.index')->with('success', 'Help updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $help = Help::find($id);
        $help->delete();
        return redirect()->route('helps.index')->with('success', 'Help deleted!');
    }
}
