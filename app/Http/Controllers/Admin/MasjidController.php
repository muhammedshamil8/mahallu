<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Masjid;


class MasjidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:masjid-list|masjid-create|masjid-edit|masjid-delete', ['only' => ['index','store']]);
         $this->middleware('permission:masjid-create', ['only' => ['create','store']]);
         $this->middleware('permission:masjid-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:masjid-delete', ['only' => ['destroy']]);
    }
    public function index()
    {   
        $masjid = Masjid::all();
         
        return view('admin.masjid.index',compact('masjid'));
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.masjid.create');
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
        $masjid = new Masjid([
            'name' => $request->get('name'),
        ]);
        $masjid->save();
        return redirect()->route('masjid.index')->with('success', 'Musjid Added Successfully!');
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
        $masjid = Masjid::find($id);
        return view('admin.masjid.edit',compact('masjid'));
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

        $masjid = Masjid::find($id);
        $masjid->name =  $request->get('name');
        $masjid->save();

        return redirect()->route('masjid.index')->with('success', 'Masjid updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $masjid = Masjid::find($id);
        $masjid->delete();
        return redirect()->route('masjid.index')->with('success', 'Masjid deleted!');
    }
}
