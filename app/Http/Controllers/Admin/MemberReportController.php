<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Relation;
use App\BloodGroup;
use App\Education;
use App\IslamicEducation;
use App\Job;
use App\MaritalStatus;
use App\PhysicalStatus;
use App\Vehicles;
use App\Member;
use Carbon\Carbon;

class MemberReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:member_reports-list|member_reports-create|member_reports-edit|member_reports-delete', ['only' => ['index','store']]);
         $this->middleware('permission:member_reports-create', ['only' => ['create','store']]);
         $this->middleware('permission:member_reports-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:member_reports-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $relations = Relation::all();
        $blood_groups = BloodGroup::all();
        $educations = Education::all();
        $islamic_educations = IslamicEducation::all();
        $jobs = Job::all();
        $marital_statoos = MaritalStatus::all();
        $physical_statoos = PhysicalStatus::all();
        $vehicles = Vehicles::all();
        return view('admin.member_report.index',compact('relations','blood_groups','educations','islamic_educations','jobs','marital_statoos','physical_statoos','vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {//dd($request);
        $data = $request->all();

        $members =  Member::select('id', 'name','gender','dob')
        ->when(!empty($data['name']) , function ($query) use($data){
            $name = $data['name'];
            return $query->where('name','LIKE', "%$name%");
        })
        ->when (!empty($data['father_name']) , function ($query) use($data){
            $father_name = $data['father_name'];
            return $query->where('father_name','LIKE', "%$father_name%");
        })
        ->when (!empty($data['mobile']) , function ($query) use($data){
            $mobile = $data['mobile'];
            return $query->where('mobile','LIKE', "%$mobile%");
        })
        ->when (!empty($data['whatsapp']) , function ($query) use($data){
            $whatsapp = $data['whatsapp'];
            return $query->where('whatsapp','LIKE', "%$whatsapp%");
        })
        ->when (!empty($data['email']) , function ($query) use($data){
            $email = $data['email'];
            return $query->where('email','LIKE', "%$email%");
        })
        ->when (!empty($data['id_card_no']) , function ($query) use($data){
            $id_card_no = $data['id_card_no'];
            return $query->where('id_card_no','LIKE', "%$id_card_no%");
        })
        ->when (!empty($data['aadhar_card_no']) , function ($query) use($data){
            $aadhar_card_no = $data['aadhar_card_no'];
            return $query->where('aadhar_card_no','LIKE', "%$aadhar_card_no%");
        })
        ->when (!empty($data['job_place']) , function ($query) use($data){
            $job_place = $data['job_place'];
            return $query->where('job_place','LIKE', "%$job_place%");
        })
        ->when (!empty($data['gender']) , function ($query) use($data){
            return $query->where('gender',$data['gender']);
        })
        ->when (!empty($data['from_age'] && !empty($data['to_age'])) , function ($query) use($data){
            // explode the range and set as follows
            $minAge = $data['from_age'];
            $maxAge = $data['to_age'];

            // prepare dates for comparison
            $minDate = Carbon::today()->subYears($maxAge); // make sure to use Carbon\Carbon in the class
            $maxDate = Carbon::today()->subYears($minAge)->endOfDay();

            // then add to the query
            return $query->whereBetween('dob', [$minDate, $maxDate]);
        })
        ->when (!empty($data['is_finding_job']) , function ($query) use($data){
            return $query->where('is_finding_job',1);
        })
        ->when (!empty($data['is_looking_marriage']) , function ($query) use($data){
            return $query->where('is_looking_marriage',1);
        })
        ->when (!empty($data['is_name_in_voter_list']) , function ($query) use($data){
            return $query->where('is_name_in_voter_list',1);
        })
        ->when (!empty($data['blood_group']) , function ($query) use($data){
            return $query->whereIn('blood_group',$data['blood_group']);
        })
        ->when (!empty($data['marital_status_id']) , function ($query) use($data){
            return $query->whereIn('marital_status_id',$data['marital_status_id']);
        })
        ->when (!empty($data['physical_status_id']) , function ($query) use($data){
            return $query->whereIn('physical_status_id',$data['physical_status_id']);
        })
        ->when (!empty($data['education']) , function ($query) use($data){
            return $query->whereJsonContains('education', $data['education']);
        })
        ->when (!empty($data['islamic_education']) , function ($query) use($data){
            return $query->whereJsonContains('islamic_education', $data['islamic_education']);
        })
        ->when (!empty($data['job']) , function ($query) use($data){
            return $query->whereJsonContains('job', $data['job']);
        })
        ->when (!empty($data['vehicles']) , function ($query) use($data){
            return $query->whereJsonContains('vehicles', $data['vehicles']);
        })
        ->get();

        foreach ($members as $key => $member) {
            $members[$key]->age = Carbon::parse($member->dob)->age;  // calculate the age
        }

        return view('admin.member_report.report',compact('members'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        return view('admin.member_report.show',compact('member','relations','blood_groups','marital_statoos','physical_statoos','year','month','day','educations','memer_education_ids','islamic_educations','memer_islamic_education_ids','jobs','memer_job_ids','vehicles','memer_vehicle_ids'));
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
