<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Donor;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:donors-list|donors-create|donors-edit|donors-delete', ['only' => ['index','store']]);
         $this->middleware('permission:donors-create', ['only' => ['create','store']]);
         $this->middleware('permission:donors-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:donors-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $donors = Donor::all();
        return view('admin.donor.index',compact('donors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.donor.create');
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
            'mobile_number'=>'required|numeric',
            'whatsapp_number'=>'nullable|numeric',
            'address'=>'nullable|string',
        ]);
        $donor = new Donor([
            'name' => $request->get('name'),
            'mobile_number' => $request->get('mobile_number'),
            'whatsapp_number' => $request->get('whatsapp_number'),
            'address' => $request->get('address'),
        ]);
        $donor->save();
        return redirect()->route('donors.index')->with('success', 'Donor Added Successfully!');
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
        $donor = Donor::find($id);
        return view('admin.donor.edit',compact('donor'));
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
            'mobile_number'=>'required|numeric',
            'whatsapp_number'=>'nullable|numeric',
            'address'=>'nullable|string',
            ]);

        $donor = Donor::find($id);
        $donor->name =  $request->get('name');
        $donor->mobile_number =  $request->get('mobile_number');
        $donor->whatsapp_number =  $request->get('whatsapp_number');
        $donor->address =  $request->get('address');
        $donor->save();

        return redirect()->route('donors.index')->with('success', 'Donor updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $donor = Donor::find($id);
        $donor->delete();
        return redirect()->route('donors.index')->with('success', 'Donor deleted!');
    }
}
