<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BankAccount;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:bank_account-list|bank_account-create|bank_account-edit|bank_account-delete', ['only' => ['index','store']]);
         $this->middleware('permission:bank_account-create', ['only' => ['create','store']]);
         $this->middleware('permission:bank_account-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:bank_account-delete', ['only' => ['destroy']]);
    }
    public function index()
    {   

        $accounts= BankAccount::all();
        return view('admin.bank.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\ResponseS
     */
    public function create()
    {   
        return view('admin.bank.create');
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
        'account_no'=>'required|numeric',
        'ifsc_code'=>'required|alpha_num',
        'branch'=>'required',
        'account_holder_name'=>'required',
        'account_type'=>'required',
        'phone_number'=>'required|numeric',
        'current_balance'=>'required|numeric',
        'address'=>'nullable',
    ]);
       $bankaccount = new BankAccount([
        'name' => $request->get('name'),
        'account_no' => $request->get('account_no'),
        'ifsc_code' => $request->get('ifsc_code'),
        'branch' => $request->get('branch'),
        'account_holder_name' => $request->get('account_holder_name'),
        'account_type' => $request->get('account_type'),
        'phone_number' => $request->get('phone_number'),
        'current_balance' => $request->get('current_balance'),
        'address' => $request->get('address'),
    ]);  
       $bankaccount->save();
       return redirect()->route('bank_account.index')->with('success', 'Bank Added Successfully!');
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
       $bankaccount = BankAccount::find($id);
       return view('admin.bank.edit',compact('bankaccount'));
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
            'account_no'=>'required|numeric',
            'ifsc_code'=>'required|alpha_num',
            'branch'=>'required',
            'account_holder_name'=>'required',
            'account_type'=>'required',
            'phone_number'=>'required|numeric',
            'current_balance'=>'required|numeric',
            'address'=>'nullable',
        ]);

        $bankaccount = BankAccount::find($id);
        $bankaccount->name =  $request->get('name');
        $bankaccount->account_no =  $request->get('account_no');
        $bankaccount->ifsc_code =  $request->get('ifsc_code');
        $bankaccount->branch =  $request->get('branch');
        $bankaccount->phone_number =  $request->get('phone_number');
        $bankaccount->current_balance =  $request->get('current_balance');
        $bankaccount->address =  $request->get('address');
        $bankaccount->save();

        return redirect()->route('bank_account.index')->with('success', 'Bank updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $bankaccount = BankAccount::find($id);
        $bankaccount->delete();
        return redirect()->route('bank_account.index')->with('success', 'Bank deleted!');
    }
}
