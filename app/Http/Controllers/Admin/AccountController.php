<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Account;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:account_list-list|account_list-create|account_list-edit|account_list-delete', ['only' => ['index','store']]);
         $this->middleware('permission:account_list-create', ['only' => ['create','store']]);
         $this->middleware('permission:account_list-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:account_list-delete', ['only' => ['destroy']]);
    }
    public function index()
    {   

        $account = Account::all(); 
        return view('admin.account.index', compact('account'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

       return view('admin.account.create');
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
            'type'=>'required',
        ]);
        $account = new account([
            'name' => $request->get('name'),
            'type' => $request->get('type'),
            'description' => $request->get('description'),
        ]);  
        $account->save();
        return redirect()->route('account_list.index')->with('success', 'Account Added Successfully!');
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
        
        $account = Account::find($id);
        return view('admin.account.edit',compact('account'));

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
            'type'=>'required',
            'description'=>'nullable',
        ]);

        $account = Account::find($id);
        $account->name =  $request->get('name');
        $account->type =  $request->get('type');
        $account->description =  $request->get('description');
        $account->save();

        return redirect()->route('account_list.index')->with('success', 'Accounts updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Account::find($id);
        $account->delete();
        return redirect()->route('account_list.index')->with('success', 'Accounts deleted!');
    }
}
