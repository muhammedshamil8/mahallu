<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ExecutiveMember;

class ExecutiveMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:executive-members-list|executive-members-create|executive-members-edit|executive-members-delete', ['only' => ['index','store']]);
         $this->middleware('permission:executive-members-create', ['only' => ['create','store']]);
         $this->middleware('permission:executive-members-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:executive-members-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $members = ExecutiveMember::all();
        return view('admin.executive_member.index',compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.executive_member.create');
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
        $executive = new ExecutiveMember([
            'name' => $request->get('name'),
            'mobile_number' => $request->get('mobile_number'),
            'whatsapp_number' => $request->get('whatsapp_number'),
            'address' => $request->get('address'),
        ]);
        $executive->save();
        return redirect()->route('executive-members.index')->with('success', 'Executive Member Added Successfully!');
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
        $member = ExecutiveMember::find($id);
        return view('admin.executive_member.edit',compact('member'));
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

        $member = ExecutiveMember::find($id);
        $member->name =  $request->get('name');
        $member->mobile_number =  $request->get('mobile_number');
        $member->whatsapp_number =  $request->get('whatsapp_number');
        $member->address =  $request->get('address');
        $member->save();

        return redirect()->route('executive-members.index')->with('success', 'Executive Member updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = ExecutiveMember::find($id);
        $member->delete();
        return redirect()->route('executive-members.index')->with('success', 'Executive Member deleted!');
    }
}
