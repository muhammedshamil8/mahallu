<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Relation;
use App\BloodGroup;
use App\Education;
use App\IslamicEducation;
use App\Job;
use App\Member;
use App\MaritalStatus;
use App\PhysicalStatus;
use App\Vehicles;

class MemberController extends Controller
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
        $family_id = $request->id;
        $relations = Relation::all();
        $blood_groups = BloodGroup::all();
        $educations = Education::all();
        $islamic_educations = IslamicEducation::all();
        $jobs = Job::all();
        $marital_statoos = MaritalStatus::all();
        $physical_statoos = PhysicalStatus::all();
        $vehicles = Vehicles::all();
        return view('admin.member.create',compact('family_id','relations','blood_groups','educations','islamic_educations','jobs','marital_statoos','physical_statoos','vehicles'));
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
            'relation'=>'required',
            'father_name'=>'nullable',
            'year'=>'nullable',
            'month'=>'nullable',
            'day'=>'nullable',
            'mobile'=>'nullable',
            'whatsapp'=>'nullable',
            'email'=>'nullable',
            'gender'=>'required',
            'blood_group'=>'nullable',
            'id_card_no'=>'nullable',
            'aadhar_card_no'=>'nullable',
            'education'=>'required',
            'islamic_education'=>'required',
            'is_finding_job'=>'nullable',
            'is_looking_marriage'=>'nullable',
            'is_name_in_voter_list'=>'nullable',
            'job'=>'required',
            'job_place'=>'nullable',
            'income'=>'nullable',
            'marital_status_id'=>'nullable',
            'physical_status_id'=>'nullable',
            'number_of_child'=>'nullable',
            'vehicles'=>'required',
            'health_info'=>'nullable',
            'gov_help_info'=>'nullable',
            'description'=>'nullable',
            //'file' =>'required|file|mimes:audio/mpeg,mpga,mp3,wav,aac'
        ]);
        //$fileName = time().'.'.$request->file->extension();  
        $fileName = 'no_photo.png';
        $year =$request->get('year');
        $month =$request->get('month');
        $day =$request->get('day');
        $is_finding_job = 0;
        $is_looking_marriage = 0;
        $is_name_in_voter_list = 0;
        if( $request->has('is_finding_job') ){
            $is_finding_job = 1;
        }

        if( $request->has('is_looking_marriage') ){
            $is_looking_marriage = 1;
        }

        if( $request->has('is_name_in_voter_list') ){
            $is_name_in_voter_list = 1;
        }

        $member = new Member([
            'family_id' => $request->get('family_id'),
            'name' => $request->get('name'),
            'relation_id' => $request->get('relation'),
            'file_name' => $fileName,
            'dob' => $year.'-'.$month.'-'.$day,
            'father_name' => $request->get('father_name'),
            'mobile' => $request->get('mobile'),
            'whatsapp' => $request->get('whatsapp'),
            'email' => $request->get('email'),
            'gender' => $request->get('gender'),
            'blood_group' => $request->get('blood_group'),
            'id_card_no' => $request->get('id_card_no'),
            'aadhar_card_no' => $request->get('aadhar_card_no'),
            'education' => $request->get('education'),
            'islamic_education' => $request->get('islamic_education'),
            'is_finding_job' => $is_finding_job,
            'is_looking_marriage' => $is_looking_marriage,
            'is_name_in_voter_list' => $is_name_in_voter_list,
            'job' => $request->get('job'),
            'job_place' => $request->get('job_place'),
            'income' => $request->get('income'),
            'marital_status_id' => $request->get('marital_status_id'),
            'physical_status_id' => $request->get('physical_status_id'),
            'number_of_child' => $request->get('number_of_child'),
            'vehicles' => $request->get('vehicles'),
            'health_info' => $request->get('health_info'),
            'gov_help_info' => $request->get('gov_help_info'),
            'description' => $request->get('description'),
        ]);
        $member->save();

        //$request->file->move(public_path('uploads/audio'), $fileName);
        return redirect()->route('families.edit', $request->get('family_id'))->with('success', 'Member Added Successfully!')->withInput(['tab'=>'custom-tabs-three-profile']);
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
        $member = Member::find($id);
        $relations = Relation::all();
        $blood_groups = BloodGroup::all();
        $marital_statoos = MaritalStatus::all();
        $physical_statoos = PhysicalStatus::all();
        $date_of_birth=explode('-',$member->dob); 
        $year = $date_of_birth[0];
        $month = $date_of_birth[1];
        $day = $date_of_birth[2];
        $educations = Education::pluck('name','id');
        $memer_education_ids =[];
        foreach ($member->education as $education) {
            $memer_education_ids[$education] = $education;
        }
        $islamic_educations = IslamicEducation::pluck('name','id');
        $memer_islamic_education_ids =[];
        foreach ($member->islamic_education as $education) {
            $memer_islamic_education_ids[$education] = $education;
        }
        $jobs = Job::pluck('name','id');
        $memer_job_ids =[];
        foreach ($member->job as $job) {
            $memer_job_ids[$job] = $job;
        }
        $vehicles =  Vehicles::pluck('name','id');
        $memer_vehicle_ids =[];
        foreach ($member->vehicles as $vehicle) {
            $memer_vehicle_ids[$vehicle] = $vehicle;
        }
        return view('admin.member.edit',compact('member','relations','blood_groups','marital_statoos','physical_statoos','year','month','day','educations','memer_education_ids','islamic_educations','memer_islamic_education_ids','jobs','memer_job_ids','vehicles','memer_vehicle_ids'));
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
            'relation'=>'required',
            'father_name'=>'nullable',
            'year'=>'nullable',
            'month'=>'nullable',
            'day'=>'nullable',
            'mobile'=>'nullable',
            'whatsapp'=>'nullable',
            'email'=>'nullable',
            'gender'=>'required',
            'blood_group'=>'nullable',
            'id_card_no'=>'nullable',
            'aadhar_card_no'=>'nullable',
            'education'=>'required',
            'islamic_education'=>'required',
            'is_finding_job'=>'nullable',
            'is_looking_marriage'=>'nullable',
            'is_name_in_voter_list'=>'nullable',
            'job'=>'required',
            'job_place'=>'nullable',
            'income'=>'nullable',
            'marital_status_id'=>'nullable',
            'physical_status_id'=>'nullable',
            'number_of_child'=>'nullable',
            'vehicles'=>'required',
            'health_info'=>'nullable',
            'gov_help_info'=>'nullable',
            'description'=>'nullable',
            //'file' =>'required|file|mimes:audio/mpeg,mpga,mp3,wav,aac'
        ]);
        $year =$request->get('year');
        $month =$request->get('month');
        $day =$request->get('day');
        $is_finding_job = 0;
        $is_looking_marriage = 0;
        $is_name_in_voter_list = 0;
        if( $request->has('is_finding_job') ){
            $is_finding_job = 1;
        }

        if( $request->has('is_looking_marriage') ){
            $is_looking_marriage = 1;
        }

        if( $request->has('is_name_in_voter_list') ){
            $is_name_in_voter_list = 1;
        }
        $member = Member::find($id);
        $member->name =  $request->get('name');
        $member->relation_id = $request->get('relation');
        $member->father_name = $request->get('father_name');
        $member->dob = $year.'-'.$month.'-'.$day;
        $member->mobile =  $request->get('mobile');
        $member->whatsapp =  $request->get('whatsapp');
        $member->email =  $request->get('email');
        $member->gender =  $request->get('gender');
        $member->blood_group = $request->get('blood_group');
        $member->id_card_no = $request->get('id_card_no');
        $member->aadhar_card_no = $request->get('aadhar_card_no');
        $member->education = $request->get('education');
        $member->islamic_education = $request->get('islamic_education');
        $member->is_finding_job = $is_finding_job;
        $member->is_looking_marriage = $is_looking_marriage;
        $member->is_name_in_voter_list = $is_name_in_voter_list;
        $member->job = $request->get('job');
        $member->job_place = $request->get('job_place');
        $member->income = $request->get('income');
        $member->marital_status_id = $request->get('marital_status_id');
        $member->physical_status_id = $request->get('physical_status_id');
        $member->number_of_child = $request->get('number_of_child');
        $member->vehicles = $request->get('vehicles');
        $member->health_info = $request->get('health_info');
        $member->gov_help_info = $request->get('gov_help_info');
        $member->description = $request->get('description');
        $member->save();

        return redirect()->route('families.edit', $member->family_id)->with('success', 'Member Details Updated Successfully!')->withInput(['tab'=>'custom-tabs-three-profile']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();
        return redirect()->route('families.edit', $member->family_id)->with('success', 'Member Deleted Successfully!')->withInput(['tab'=>'custom-tabs-three-profile']);
    }
}
