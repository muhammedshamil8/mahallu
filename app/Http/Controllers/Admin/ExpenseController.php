<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaction;
use App\Staff;
use App\Shop;
use App\Account;
use App\Committe;
use App\Receiver;
use App\BankAccount;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:expense-list|expense-create|expense-edit|expense-delete', ['only' => ['index','store']]);
         $this->middleware('permission:expense-create', ['only' => ['create','store']]);
         $this->middleware('permission:expense-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:expense-delete', ['only' => ['destroy']]);
    }
    public function index()
    {

     $expenses= Transaction::where('transaction_type','expense')->get();
     return view('admin.expense.index', compact('expenses'));
 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staffs= Staff::all();
        $shops= Shop::all();
        $banks= BankAccount::all(); 
        $account = Account::whereIn('type', array('expense', 'both'))->get();
        $committe = Committe::all();
        $receivers = Receiver::all();
        return view('admin.expense.create', compact('staffs','shops','banks','account','committe','receivers'));
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
            'paid_to'=>'required',
            'amount'=>'required',
            'staff' => Rule::requiredIf($request->paid_to == 'staff'),
            'shop' => Rule::requiredIf($request->paid_to == 'shop'),
            'paid_to_other' => Rule::requiredIf($request->paid_to == 'other'),
            'towards'=>'required',
            'committee'=>'required',
            'payment_mode'=>'required',
            'payer' => Rule::requiredIf($request->payment_mode == 'cashbtn'),
            'bank' => Rule::requiredIf($request->payment_mode == 'bankbtn'),
            'transaction_number' => Rule::requiredIf($request->payment_mode == 'bankbtn'),
            'check_details' => Rule::requiredIf($request->payment_mode == 'checkbtn'),
            'check_bank_name' => Rule::requiredIf($request->payment_mode == 'checkbtn'),
        ],
[ 'receipt_number.unique' => 'The voucher number has already been taken.']
    );
        $expense = new Transaction([
            'receipt_number' => $request->get('receipt_number'),
            'date' => $request->get('date'),
            'transaction_type'=>'expense',
            'amount' => $request->get('amount'),
            'paid_to' => $request->get('paid_to'),
            'staff_id' => $request->get('paid_to') == 'staff' ? $request->get('staff') : '',
        'shop_id' => $request->get('paid_to') == 'shop' ? $request->get('shop') : '',
        'paid_to_other' => $request->get('paid_to') == 'other' ? $request->get('paid_to_other') : '',
            'towards_id' => $request->get('towards'),
            'committee_id' => $request->get('committee'),
            'payment_mode' => $request->get('payment_mode'),
            'payer_id' => $request->get('payment_mode') == 'cashbtn' ? $request->get('payer') : '',
            'bank_id' => $request->get('payment_mode') == 'bankbtn' ? $request->get('bank') : '',
            'transaction_number' => $request->get('payment_mode') == 'bankbtn' ? $request->get('transaction_number') : '',
            'check_details' => $request->get('payment_mode') == 'checkbtn' ? $request->get('check_details') : '',
            'check_bank_name' => $request->get('payment_mode') == 'checkbtn' ? $request->get('check_bank_name') : '',
            'description' => $request->get('description'),
        ]);  
        $expense->save();
        return redirect()->route('expense.index')->with('success', 'Expense Added Successfully!');
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
        $expense = Transaction::find($id);
        $staffs= Staff::all();
        $shops= Shop::all();
        $banks= BankAccount::all();       
        $accounts = Account::all();
        $committe = Committe::all();
        $receivers = Receiver::all();
        return view('admin.expense.edit', compact('expense','staffs','shops','banks','accounts','committe','receivers'));
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
            'paid_to'=>'required',
            'staff' => Rule::requiredIf($request->received_from == 'staff'),
            'shop' => Rule::requiredIf($request->received_from == 'shop'),
            'paid_to_other' => Rule::requiredIf($request->received_from == 'other'),
            'amount'=>'required',
            'towards'=>'required',
            'committee'=>'required',
            'payment_mode'=>'required',
            'payer' => Rule::requiredIf($request->payment_mode == 'cashbtn'),
            'bank' => Rule::requiredIf($request->payment_mode == 'bankbtn'),
            'transaction_number' => Rule::requiredIf($request->payment_mode == 'bankbtn'),
            'check_details' => Rule::requiredIf($request->payment_mode == 'checkbtn'),
            'check_bank_name' => Rule::requiredIf($request->payment_mode == 'checkbtn'),
        ]);
        $expense = Transaction::find($id);
        $expense->receipt_number =  $request->get('receipt_number');
        $expense->date = $request->get('date');
        $expense->amount = $request->get('amount');
        $expense->paid_to = $request->get('paid_to');
        $expense->staff_id = $request->get('paid_to') == 'staff' ? $request->get('staff'): '';
        $expense->shop_id = $request->get('paid_to') == 'shop' ? $request->get('shop') : '';
        $expense->paid_to_other = $request->get('paid_to') == 'other' ? $request->get('paid_to_other') : '';
        $expense->towards_id = $request->get('towards');
        $expense->committee_id = $request->get('committee');
        $expense->payment_mode = $request->get('payment_mode');
        $expense->payer_id = $request->get('payment_mode') == 'cashbtn' ? $request->get('payer') : '';
        $expense->bank_id = $request->get('payment_mode') == 'bankbtn' ? $request->get('bank') : '';
        $expense->transaction_number = $request->get('payment_mode') == 'bankbtn' ? $request->get('transaction_number') : '';
        $expense->check_details = $request->get('payment_mode') == 'checkbtn' ? $request->get('check_details') : '';
        $expense->check_bank_name = $request->get('payment_mode') == 'checkbtn' ? $request->get('check_bank_name') : '';
        $expense->description = $request->get('description');
        $expense->save();
        return redirect()->route('expense.index')->with('success', 'Expense Details Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Transaction::find($id);
        $expense->delete();
        return redirect()->route('expense.index')->with('success', 'Expense details deleted successfully!');
    }
}
