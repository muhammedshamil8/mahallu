<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Staff;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:staffs-list|staffs-create|staffs-edit|staffs-delete', ['only' => ['index','store']]);
         $this->middleware('permission:staffs-create', ['only' => ['create','store']]);
         $this->middleware('permission:staffs-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:staffs-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $staffs = Staff::all();
        return view('admin.staff.index',compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.staff.create');
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
        $staff = new Staff([
            'name' => $request->get('name'),
            'mobile_number' => $request->get('mobile_number'),
            'whatsapp_number' => $request->get('whatsapp_number'),
            'address' => $request->get('address'),
        ]);
        $staff->save();
        return redirect()->route('staffs.index')->with('success', 'Staff Added Successfully!');
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
        $staff = Staff::find($id);
        return view('admin.staff.edit',compact('staff'));
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

        $staff = Staff::find($id);
        $staff->name =  $request->get('name');
        $staff->mobile_number =  $request->get('mobile_number');
        $staff->whatsapp_number =  $request->get('whatsapp_number');
        $staff->address =  $request->get('address');
        $staff->save();

        return redirect()->route('staffs.index')->with('success', 'Staff updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::find($id);
        $staff->delete();
        return redirect()->route('staffs.index')->with('success', 'Staff deleted Successfully!!');
    }
}
