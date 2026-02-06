<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Designation;
use App\Member;
use App\CommitteeMember;
use App\ExecutiveMember;

class CommitteeMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $committee_id = $request->id;
        $designations =Designation::all();
        $members =Member::all();
        $exe_members =ExecutiveMember::all();
        return view('admin.committee_member.create',compact('committee_id','designations','members','exe_members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {//dd($request);
        if($request->get('member_type') == 'member'){
            $request->validate([
                'member_id'=>'required|unique:committee_members|max:255',
                'designation'=>'required',
            ]);
        }
        if($request->get('member_type') == 'non_member'){
            $request->validate([
                'non_member_id'=>'required|unique:committee_members|max:255',
                'designation'=>'required',
            ]);
        }
        $member = new CommitteeMember([
            'committee_id' => $request->get('committee_id'),
            'member_id' => $request->get('member_type') == 'member' ? $request->get('member_id') : 0,
            'non_member_id' => $request->get('member_type') == 'non_member' ? $request->get('non_member_id') : 0,
            'designation_id' => $request->get('designation'),
            'member_type' => $request->get('member_type'),
        ]);
        $member->save();

        return redirect()->route('committe.edit', $request->get('committee_id'))->with('success', 'Member Added Successfully!')->withInput(['tab'=>'custom-tabs-three-profile']);
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
        $committee_member = CommitteeMember::find($id);
        $designations =Designation::all();
        $members =Member::all();
        $exe_members =ExecutiveMember::all();
        return view('admin.committee_member.edit',compact('committee_member','designations','members','exe_members'));
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
            'member'=>'required',
            'designation'=>'required',
        ]);
        $committee_member = CommitteeMember::find($id);
        $committee_member->member_id =  $request->get('member');
        $committee_member->designation_id = $request->get('designation');
        $committee_member->save();

        return redirect()->route('committe.edit', $committee_member->committee_id)->with('success', 'Member Details Updated Successfully!')->withInput(['tab'=>'custom-tabs-three-profile']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $committee_member = CommitteeMember::find($id);
        $committee_member->delete();
        return redirect()->route('committe.edit', $committee_member->committee_id)->with('success', 'Member Deleted Successfully!')->withInput(['tab'=>'custom-tabs-three-profile']);
    }
}
