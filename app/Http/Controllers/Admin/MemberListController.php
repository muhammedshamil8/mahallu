<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Committe;
use App\Member;
use App\Designation;
use App\Memberlist;
use App\BloodGroup;


class MemberListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
       
        $member = Member::all();
        $designation = Designation::all();
        return view('admin.member.addCommitte', compact('member','designation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
    {   
       
        $member_id = $request->id;
        
        //dd($member_id);
        $member = Member::all();

        return view('admin.member.addCommitte');
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
            'member'=>'required',
            'designation'=>'required',
            'designation'=>'required',
        ]);
        $memberlist = new Memberlist([
            'committe_id' => $request->get('committe_id'),
            'member' => $request->get('member'),
            'designation' => $request->get('designation'),
            'description' => $request->get('description'),
        ]);
        $memberlist->save();
        //return redirect()->route('member.index')->with('success', 'Member Added Successfully!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
         //dd($id);


        
       
          $committe_id = $id;
          $designation = Designation::all();
          $member = Member::all(); 
          $committe = Committe::all();
          $committeOne = Committe::find($committe_id);
          $committe_name = Committe::where('id',$committeOne->id)->value('name');
          //return DB::table('blood_groups')->get();
          
        $data= DB::table('committes')
        ->join('memberlists','committes.id','memberlists.committe_id')
        ->orderBy('memberlists.created_at', 'desc')
        ->get();


        return view('admin.member.addCommitte', compact('committe_id','designation','committe','member', 'committe_name','data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
