<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Family;
use App\Member;
use App\FinancialStatus;
use App\HouseOwnership;
use App\HouseType;
use App\RationCard;
use App\Vehicles;
use App\District;
use App\Relegion;
use App\Masjid;
use Illuminate\Support\Facades\DB;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:family-list|family-create|family-edit|family-delete', ['only' => ['index','store']]);
         $this->middleware('permission:family-create', ['only' => ['create','store']]);
         $this->middleware('permission:family-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:family-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $families = Family::all();
        return view('admin.family.index',compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $financial_statoos = FinancialStatus::all();
        $house_ownerships = HouseOwnership::all();
        $house_types = HouseType::all();
        $district = District::all();
        $relegion = Relegion::all();
        $masjids = Masjid::all();
        $ration_cards = RationCard::all();
        $vehicles = Vehicles::all();
        return view('admin.family.create',compact('financial_statoos','house_ownerships','house_types','ration_cards','vehicles','district','relegion','masjids'));
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
            'head_of_family'=>'required',
            'house_name'=>'nullable',
            'house_number'=>'nullable',
            'name_of_field'=>'nullable',
            'mobile_number'=>'nullable|numeric',
            'whatsapp_number'=>'nullable|numeric',
            'pin_number'=>'nullable|numeric',
            'ward_no'=>'nullable',
            'area_of_land'=>'nullable',
            'place'=>'nullable',
            'district'=>'nullable',
            'relegion'=>'nullable',
            'post_no'=>'nullable',
            'land_mark'=>'nullable',
            'type_of_house'=>'nullable',
            'well'=>'nullable',
            'water_connection'=>'nullable',
            'gas'=>'nullable',
            'ration_card'=>'nullable',
            'ration_card_no'=>'nullable',
            'house_ownership'=>'nullable',
            'house_owner_name'=>'nullable',
            'financial_status'=>'nullable',
            'vehicles'=>'required',
            'favorite_masjid'=>'required',
            'description'=>'nullable',
        ]);

        $data = $request->all();//dd($data);
        
        DB::beginTransaction();
        try {
            $family = Family::create($data);
            // now save head of family as member
            $memberData = [
                'family_id' => $family->id,
                'name' => $data['head_of_family'],
                'mobile' => $data['mobile_number'],
                'whatsapp' => $data['whatsapp_number'],
                'relation_id' => '1',
                'dob' => '1900-01-01',
                'education' => ["1"],
                'islamic_education' => ["1"],
                'job' => ["1"],
                'vehicles' => $data['vehicles'],
                //'masjid' => $data['favorite_masjid'],
                'description' => $data['description'],
            ];

            Member::create($memberData);
            // now commit the database
            DB::commit();
            return redirect()->route('families.edit', $family->id)->with('success', 'Family Added Successfully!')->withInput(['tab'=>'custom-tabs-three-profile']);
        }
        catch(\Exception $e){
            DB::rollback();
            $message = str_replace(array("\r", "\n","'","`"), ' ', $e->getMessage());dd($message);
            return redirect()->route('families.create')->with("error",$message);
        }
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
        $family = Family::find($id);
        $financial_statoos = FinancialStatus::all();
        $house_ownerships = HouseOwnership::all();
        $house_types = HouseType::all();
        $district = District::all();
        $relegion = Relegion::all();
        $ration_cards = RationCard::all();
        $members = Member::where('family_id',$id)->get();
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
        return view('admin.family.edit',compact('family','members','financial_statoos','house_ownerships','house_types','district','relegion','ration_cards','vehicles','family_vehicle_ids','masjids','family_masjid_ids'));
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
            'head_of_family'=>'required',
            'house_name'=>'nullable',
            'house_number'=>'nullable',
            'name_of_field'=>'nullable',
            'mobile_number'=>'nullable|numeric',
            'whatsapp_number'=>'nullable|numeric',
            'pin_number'=>'nullable|numeric',
            'ward_no'=>'nullable',
            'area_of_land'=>'nullable',
            'place'=>'nullable',
            'district'=>'nullable',
            'relegion'=>'nullable',
            'post_no'=>'nullable',
            'land_mark'=>'nullable',
            'type_of_house'=>'nullable',
            'well'=>'nullable',
            'water_connection'=>'nullable',
            'gas'=>'nullable',
            'ration_card'=>'nullable',
            'ration_card_no'=>'nullable',
            'house_ownership'=>'nullable',
            'house_owner_name'=>'nullable',
            'financial_status'=>'nullable',
            'vehicles'=>'required',
            'favorite_masjid'=>'required',
            'description'=>'nullable',
        ]);

        $family = Family::find($id);
        $family->head_of_family =  $request->get('head_of_family');
        $family->house_name = $request->get('house_name');
        $family->house_number = $request->get('house_number');
        $family->name_of_field =  $request->get('name_of_field');
        $family->mobile_number =  $request->get('mobile_number');
        $family->whatsapp_number =  $request->get('whatsapp_number');
        $family->pin_number =  $request->get('pin_number');
        $family->ward_no =  $request->get('ward_no');
        $family->area_of_land =  $request->get('area_of_land');
        $family->place =  $request->get('place');
        $family->district =  $request->get('district');
        $family->relegion =  $request->get('relegion');
        $family->post_no =  $request->get('post_no');
        $family->land_mark = $request->get('land_mark');
        $family->type_of_house = $request->get('type_of_house');
        $family->well = $request->get('well');
        $family->water_connection = $request->get('water_connection');
        $family->gas = $request->get('gas');
        $family->ration_card = $request->get('ration_card');
        $family->ration_card_no = $request->get('ration_card_no');
        $family->house_ownership = $request->get('house_ownership');
        $family->house_owner_name = $request->get('house_owner_name');
        $family->financial_status = $request->get('financial_status');
        $family->vehicles = $request->get('vehicles');
        $family->favorite_masjid = $request->get('favorite_masjid');
        $family->description = $request->get('description');
        $family->save();

        return redirect()->route('families.index')->with('success', 'Family Details updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $family = Family::find($id);
        $family->delete();
        return redirect()->route('families.index')->with('success', 'Family deleted!');
    }
}
