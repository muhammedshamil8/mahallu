<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaction;
use App\Account;
use App\Committe;
use App\Receiver;
use App\BankAccount;
use App\Member;
use App\Donor;
use App\Staff;
use App\Shop;
use App\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TranReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:tran_reports-list|tran_reports-create|tran_reports-edit|tran_reports-delete', ['only' => ['index','store']]);
         $this->middleware('permission:tran_reports-create', ['only' => ['create','store']]);
         $this->middleware('permission:tran_reports-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:tran_reports-delete', ['only' => ['destroy']]);
    }
    public function index()
    {   
        $account = Account::all();
        $committe = Committe::all();
        $receiver = Receiver::all();
        $banks= BankAccount::all(); 
        $members = DB::table('members')
         ->join('families', 'members.family_id', '=', 'families.id')
         ->select('members.id','members.name', 'families.house_name')->get();
        $donors= Donor::all();
        $staffs= Staff::all();
        $shops= Shop::all();
        $students= Student::all();
        return view('admin.tran_report.index',compact('account','committe','receiver','banks','members','donors','staffs','shops','students'));
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
        $request->validate([
            'from'=>'required|date',
            'to'=>'required|date',
        ]);
        $start_date = date('Y-m-d 00:00:00', strtotime($request->get('from')));
        $end_date = date('Y-m-d 23:59:59', strtotime($request->get('to')));

        $data = $request->all();

        $trans = Transaction::where('date','>=',$start_date)
        ->where('date','<=',$end_date)
        
        ->when (!empty($data['towards']) , function ($query) use($data){
            return $query->where('towards_id',$data['towards']);
        })
        ->when (!empty($data['committee']) , function ($query) use($data){
            return $query->where('committee_id',$data['committee']);
        })
        ->when (!empty($data['receiver']) , function ($query) use($data){
            return $query->where('receiver_id',$data['receiver']);
        })
        ->when (!empty($data['bank']) , function ($query) use($data){
            return $query->where('bank_id',$data['bank']);
        })
        ->when (!empty($data['member']) , function ($query) use($data){
            return $query->where('member_id',$data['member']);
        })
        ->when (!empty($data['donor']) , function ($query) use($data){
            return $query->where('donor_id',$data['donor']);
        })
        ->when (!empty($data['staff']) , function ($query) use($data){
            return $query->where('staff_id',$data['staff']);
        })
        ->when (!empty($data['shop']) , function ($query) use($data){
            return $query->where('shop_id',$data['shop']);
        })
        ->when (!empty($data['type']) , function ($query) use($data){
            return $query->where('transaction_type',$data['type']);
        })
        ->when (!empty($data['mode']) , function ($query) use($data){
            return $query->where('payment_mode',$data['mode']);
        })
        ->when (!empty($data['student']) , function ($query) use($data){
            return $query->where('student_id',$data['student']);
        })
        ->get();

        $opening_credit = DB::table('transactions')
        ->where('date', '<', $start_date)
        ->when (!empty($data['towards']) , function ($query) use($data){
            return $query->where('towards_id',$data['towards']);
        })
        ->when (!empty($data['committee']) , function ($query) use($data){
            return $query->where('committee_id',$data['committee']);
        })
        ->when (!empty($data['receiver']) , function ($query) use($data){
            return $query->where('receiver_id',$data['receiver']);
        })
        ->when (!empty($data['bank']) , function ($query) use($data){
            return $query->where('bank_id',$data['bank']);
        })
        ->when (!empty($data['member']) , function ($query) use($data){
            return $query->where('member_id',$data['member']);
        })
        ->when (!empty($data['donor']) , function ($query) use($data){
            return $query->where('donor_id',$data['donor']);
        })
        ->when (!empty($data['staff']) , function ($query) use($data){
            return $query->where('staff_id',$data['staff']);
        })
        ->when (!empty($data['shop']) , function ($query) use($data){
            return $query->where('shop_id',$data['shop']);
        })
        ->when (!empty($data['type']) , function ($query) use($data){
            return $query->where('transaction_type',$data['type']);
        })
        ->when (!empty($data['mode']) , function ($query) use($data){
            return $query->where('payment_mode',$data['mode']);
        })
        ->when (!empty($data['student']) , function ($query) use($data){
            return $query->where('student_id',$data['student']);
        })
        ->where('transaction_type', 'income')
        ->sum('amount');

        $opening_debit = DB::table('transactions')
        ->where('date', '<', $start_date)
        ->when (!empty($data['towards']) , function ($query) use($data){
            return $query->where('towards_id',$data['towards']);
        })
        ->when (!empty($data['committee']) , function ($query) use($data){
            return $query->where('committee_id',$data['committee']);
        })
        ->when (!empty($data['receiver']) , function ($query) use($data){
            return $query->where('receiver_id',$data['receiver']);
        })
        ->when (!empty($data['bank']) , function ($query) use($data){
            return $query->where('bank_id',$data['bank']);
        })
        ->when (!empty($data['member']) , function ($query) use($data){
            return $query->where('member_id',$data['member']);
        })
        ->when (!empty($data['donor']) , function ($query) use($data){
            return $query->where('donor_id',$data['donor']);
        })
        ->when (!empty($data['staff']) , function ($query) use($data){
            return $query->where('staff_id',$data['staff']);
        })
        ->when (!empty($data['shop']) , function ($query) use($data){
            return $query->where('shop_id',$data['shop']);
        })
        ->when (!empty($data['type']) , function ($query) use($data){
            return $query->where('transaction_type',$data['type']);
        })
        ->when (!empty($data['mode']) , function ($query) use($data){
            return $query->where('payment_mode',$data['mode']);
        })
        ->when (!empty($data['student']) , function ($query) use($data){
            return $query->where('student_id',$data['student']);
        })
        ->where('transaction_type', 'expense')
        ->sum('amount');
        $opening_balance = $opening_credit - $opening_debit;

        return view('admin.tran_report.report',compact('start_date','end_date','trans','opening_balance'));
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
