<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaction;
use App\Member;
use App\Donor;
use App\Student;
use App\Account;
use App\Committe;
use App\Receiver;
use App\BankAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:income-list|income-create|income-edit|income-delete', ['only' => ['index','store']]);
         $this->middleware('permission:income-create', ['only' => ['create','store']]);
         $this->middleware('permission:income-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:income-delete', ['only' => ['destroy']]);
    }
    public function index()
    {  
     $incomes= Transaction::where('transaction_type','income')->get();
     return view('admin.income.index', compact('incomes'));
 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
     $members = DB::table('members')
     ->join('families', 'members.family_id', '=', 'families.id')
     ->select('members.id','members.name', 'families.house_name')->get();
     $donors= Donor::all();
     $students= Student::all();
     $banks= BankAccount::all();       
     $account = Account::all();
     $committe = Committe::all();
     $receiver = Receiver::all();
     return view('admin.income.create', compact('members','donors','students','banks','account','committe','receiver'));
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
            'receipt_number' => 'nullable|unique:transactions|max:255',
            'amount'=>'required',
            'received_from'=>'required',
            'member' => Rule::requiredIf($request->received_from == 'member'),
            'donor' => Rule::requiredIf($request->received_from == 'donor'),
            'student' => Rule::requiredIf($request->received_from == 'student'),
            'received_from_other' => Rule::requiredIf($request->received_from == 'other'),
            'towards'=>'required',
            'committee'=>'required',
            'payment_mode'=>'required',
            'receiver' => Rule::requiredIf($request->payment_mode == 'cashbtn'),
            'bank' => Rule::requiredIf($request->payment_mode == 'bankbtn'),
            'transaction_number' => Rule::requiredIf($request->payment_mode == 'bankbtn'),
            'check_details' => Rule::requiredIf($request->payment_mode == 'checkbtn'),
        ]);
        $income = new Transaction([
            'receipt_number' => $request->get('receipt_number'),
            'date' => $request->get('date'),
            'transaction_type' => 'income',
            'amount' => $request->get('amount'),
            'received_from' => $request->get('received_from'),
            'member_id' => $request->get('received_from') == 'member' ? $request->get('member') : '',
        'donor_id' => $request->get('received_from') == 'donor' ? $request->get('donor') : '',
        'student_id' => $request->get('received_from') == 'student' ? $request->get('student') : '',
        'received_from_other' => $request->get('received_from') == 'other' ? $request->get('received_from_other') : '',
            'towards_id' => $request->get('towards'),
            'committee_id' => $request->get('committee'),
            'payment_mode' => $request->get('payment_mode'),
            'receiver_id' => $request->get('payment_mode') == 'cashbtn' ? $request->get('receiver') : '',
            'bank_id' => $request->get('payment_mode') == 'bankbtn' ? $request->get('bank') : '',
            'transaction_number' => $request->get('payment_mode') == 'bankbtn' ? $request->get('transaction_number') : '',
            'check_details' => $request->get('payment_mode') == 'checkbtn' ? $request->get('check_details') : '',
            'description' => $request->get('description'),
        ]);  
        $income->save();
        return redirect()->route('income.index')->with('success', 'Income Added Successfully!');
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
        $income = Transaction::find($id);
        $members= Member::all();
        $donors= Donor::all();
        $students= Student::all();
        $banks= BankAccount::all();       
        $account = Account::all();
        $committe = Committe::all();
        $receiver = Receiver::all();
        return view('admin.income.edit', compact('income','members','donors','students','banks','account','committe','receiver'));
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
            'receipt_number' => 'nullable|unique:transactions,receipt_number,'.$id.'|max:255',
            'amount'=>'required',
            'received_from'=>'required',
            'member' => Rule::requiredIf($request->received_from == 'member'),
            'donor' => Rule::requiredIf($request->received_from == 'donor'),
            'student' => Rule::requiredIf($request->received_from == 'student'),
            'received_from_other' => Rule::requiredIf($request->received_from == 'other'),
            'towards'=>'required',
            'committee'=>'required',
            'payment_mode'=>'required',
            'receiver' => Rule::requiredIf($request->payment_mode == 'cashbtn'),
            'bank' => Rule::requiredIf($request->payment_mode == 'bankbtn'),
            'transaction_number' => Rule::requiredIf($request->payment_mode == 'bankbtn'),
            'check_details' => Rule::requiredIf($request->payment_mode == 'checkbtn'),
        ]);
        $income = Transaction::find($id);
        $income->receipt_number =  $request->get('receipt_number');
        $income->date = $request->get('date');
        $income->amount = $request->get('amount');
        $income->received_from = $request->get('received_from');
        $income->member_id = $request->get('received_from') == 'member' ? $request->get('member') : '';
        $income->donor_id = $request->get('received_from') == 'donor' ? $request->get('donor') : '';
        $income->student_id = $request->get('received_from') == 'student' ? $request->get('student') : '';
        $income->received_from_other = $request->get('received_from') == 'other' ? $request->get('received_from_other') : '';
        $income->towards_id = $request->get('towards');
        $income->committee_id = $request->get('committee');
        $income->payment_mode = $request->get('payment_mode');
        $income->receiver_id = $request->get('payment_mode') == 'cashbtn' ? $request->get('receiver') : '';
        $income->bank_id = $request->get('payment_mode') == 'bankbtn' ? $request->get('bank') : '';
        $income->transaction_number = $request->get('payment_mode') == 'bankbtn' ? $request->get('transaction_number') : '';
        $income->check_details = $request->get('payment_mode') == 'checkbtn' ? $request->get('check_details') : '';
        $income->description = $request->get('description');
        $income->save();
        return redirect()->route('income.index')->with('success', 'Income Details Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $income = Transaction::find($id);
        $income->delete();
        return redirect()->route('income.index')->with('success', 'Income deleted!');
    }
}
