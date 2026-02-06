<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Beneficiary;
use App\Help;

class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:beneficiaries-list|beneficiaries-create|beneficiaries-edit|beneficiaries-delete', ['only' => ['index','store']]);
         $this->middleware('permission:beneficiaries-create', ['only' => ['create','store']]);
         $this->middleware('permission:beneficiaries-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:beneficiaries-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $beneficiaries = Beneficiary::all();
        return view('admin.beneficiary.index',compact('beneficiaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $helps = Help::all();
        return view('admin.beneficiary.create',compact('helps'));
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
            'helps'=>'required',
            'mobile_number'=>'required|numeric',
            'whatsapp_number'=>'nullable|numeric',
            'address'=>'nullable|string',
        ]);
        $beneficiary = new Beneficiary([
            'name' => $request->get('name'),
            'helps' => $request->get('helps'),
            'mobile_number' => $request->get('mobile_number'),
            'whatsapp_number' => $request->get('whatsapp_number'),
            'address' => $request->get('address'),
        ]);
        $beneficiary->save();
        return redirect()->route('beneficiaries.index')->with('success', 'Beneficiary Added Successfully!');
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
        $beneficiary = Beneficiary::find($id);
        $helps =  Help::pluck('name','id');
        $beneficiary_help_ids =[];
        foreach ($beneficiary->helps as $help) {
            $beneficiary_help_ids[$help] = $help;
        }
        return view('admin.beneficiary.edit',compact('beneficiary','helps','beneficiary_help_ids'));
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
            'helps'=>'required',
            'mobile_number'=>'required|numeric',
            'whatsapp_number'=>'nullable|numeric',
            'address'=>'nullable|string',
            ]);

        $beneficiary = Beneficiary::find($id);
        $beneficiary->name =  $request->get('name');
        $beneficiary->helps =  $request->get('helps');
        $beneficiary->mobile_number =  $request->get('mobile_number');
        $beneficiary->whatsapp_number =  $request->get('whatsapp_number');
        $beneficiary->address =  $request->get('address');
        $beneficiary->save();

        return redirect()->route('beneficiaries.index')->with('success', 'Beneficiary updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $beneficiary = Beneficiary::find($id);
        $beneficiary->delete();
        return redirect()->route('beneficiaries.index')->with('success', 'Beneficiary deleted!');
    }
}
