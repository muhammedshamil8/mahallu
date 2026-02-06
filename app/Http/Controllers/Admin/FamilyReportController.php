<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Family;
use App\Member;
use App\FinancialStatus;
use App\HouseOwnership;
use App\HouseType;
use App\District;
use App\Relegion;
use App\RationCard;
use App\Vehicles;
use App\Masjid;
use Carbon\Carbon;


class FamilyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:family_reports-list|family_reports-create|family_reports-edit|family_reports-delete', ['only' => ['index','store']]);
         $this->middleware('permission:family_reports-create', ['only' => ['create','store']]);
         $this->middleware('permission:family_reports-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:family_reports-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $financial_statoos = FinancialStatus::all();
        $house_ownerships = HouseOwnership::all();
        $house_types = HouseType::all();
        $district = District::all();
        $relegion = Relegion::all();
        $ration_cards = RationCard::all();
        $vehicles = Vehicles::all();
        return view('admin.family_report.index',compact('financial_statoos','house_ownerships','house_types','district','relegion','ration_cards','vehicles'));
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
    {
        $data = $request->all();

        $families =  Family::select('id', 'head_of_family','house_name','name_of_field')
        ->when(!empty($data['head_of_family']) , function ($query) use($data){
            $head_of_family = $data['head_of_family'];
            return $query->where('head_of_family','LIKE', "%$head_of_family%");
        })
        ->when(!empty($data['house_name']) , function ($query) use($data){
            $house_name = $data['house_name'];
            return $query->where('house_name','LIKE', "%$house_name%");
        })
        ->when(!empty($data['house_number']) , function ($query) use($data){
            $house_number = $data['house_number'];
            return $query->where('house_number','LIKE', "%$house_number%");
        })
        ->when(!empty($data['name_of_field']) , function ($query) use($data){
            $name_of_field = $data['name_of_field'];
            return $query->where('name_of_field','LIKE', "%$name_of_field%");
        })
        ->when(!empty($data['mobile_number']) , function ($query) use($data){
            $mobile_number = $data['mobile_number'];
            return $query->where('mobile_number','LIKE', "%$mobile_number%");
        })
        ->when(!empty($data['whatsapp_number']) , function ($query) use($data){
            $whatsapp_number = $data['whatsapp_number'];
            return $query->where('whatsapp_number','LIKE', "%$whatsapp_number%");
        })
        ->when(!empty($data['pin_number']) , function ($query) use($data){
            $pin_number = $data['pin_number'];
            return $query->where('pin_number','LIKE', "%$pin_number%");
        })
        ->when(!empty($data['ward_no']) , function ($query) use($data){
            return $query->where('ward_no', $data['ward_no']);
        })
        ->when(!empty($data['place']) , function ($query) use($data){
            $place = $data['place'];
            return $query->where('place','LIKE', "%$place%");
        })
        ->when(!empty($data['district']) , function ($query) use($data){
            return $query->where('district', $data['district']);
        })
        ->when(!empty($data['relegion']) , function ($query) use($data){
            return $query->where('relegion', $data['relegion']);
        })
        ->when(!empty($data['ration_card_no']) , function ($query) use($data){
            $ration_card_no = $data['ration_card_no'];
            return $query->where('ration_card_no','LIKE', "%$ration_card_no%");
        })
        ->when(!empty($data['house_owner_name']) , function ($query) use($data){
            $house_owner_name = $data['house_owner_name'];
            return $query->where('house_owner_name','LIKE', "%$house_owner_name%");
        })
        ->when(!empty($data['favorite_masjid']) , function ($query) use($data){
            $favorite_masjid = $data['favorite_masjid'];
            return $query->where('favorite_masjid','LIKE', "%$favorite_masjid%");
        })
        ->when (!empty($data['from_cent'] && !empty($data['to_cent'])) , function ($query) use($data){
            // explode the range and set as follows
            $min = $data['from_cent'];//dd($min);
            $max = $data['to_cent'];//dd($max);
            return $query->whereBetween('area_of_land', [$min,$max]);
        })
        ->when (!empty($data['well']) , function ($query) use($data){
            return $query->where('well',1);
        })
        ->when (!empty($data['water_connection']) , function ($query) use($data){
            return $query->where('water_connection',1);
        })
        ->when (!empty($data['gas']) , function ($query) use($data){
            return $query->where('gas',1);
        })
        ->when (!empty($data['type_of_house']) , function ($query) use($data){
            return $query->whereIn('type_of_house', $data['type_of_house']);
        })
        ->when (!empty($data['ration_card']) , function ($query) use($data){
            return $query->whereIn('ration_card', $data['ration_card']);
        })
        ->when (!empty($data['house_ownership']) , function ($query) use($data){
            return $query->whereIn('house_ownership', $data['house_ownership']);
        })
        ->when (!empty($data['financial_status']) , function ($query) use($data){
            return $query->whereIn('financial_status', $data['financial_status']);
        })
        ->when (!empty($data['vehicles']) , function ($query) use($data){
            return $query->whereJsonContains('vehicles', $data['vehicles']);
        })
        ->get();

        return view('admin.family_report.report',compact('families'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $family = Family::find($id);
        $financial_statoos = FinancialStatus::all();
        $house_ownerships = HouseOwnership::all();
        $house_types = HouseType::all();
        $district = District::all();
        $relegion = Relegion::all();
        $ration_cards = RationCard::all();
        $members = Member::where('family_id',$id)->get();
        foreach ($members as $key => $member) {
            $members[$key]->age = Carbon::parse($member->dob)->age;  // calculate the age
        }
        $vehicles =  Vehicles::pluck('name','id');
        $family_vehicle_ids =[];
        foreach ($family->vehicles as $vehicle) {
            $family_vehicle_ids[$vehicle] = $vehicle;
        }
        $masjids =  Masjid::pluck('name','id');
        $family_masjid_ids =[];
        foreach ($family->favorite_masjid as $masjid) {
            $family_masjid_ids[$masjid] = $masjid;
        }
        return view('admin.family_report.show',compact('family','members','financial_statoos','house_ownerships','house_types','district','relegion','ration_cards','vehicles','family_vehicle_ids','masjids','family_masjid_ids'));
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
