<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Receiver;

class ReceiverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:receiver_list-list|receiver_list-create|receiver_list-edit|receiver_list-delete', ['only' => ['index','store']]);
         $this->middleware('permission:receiver_list-create', ['only' => ['create','store']]);
         $this->middleware('permission:receiver_list-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:receiver_list-delete', ['only' => ['destroy']]);
    }
    public function index()
    {   

        $receiver = Receiver::all(); 
        return view('admin.receiver.index', compact('receiver'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.receiver.create');
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
            'mobile_number'=>'required|numeric',
            'whatsapp_number'=>'nullable|numeric',
            'address'=>'nullable|string',
        ]);
        $receiver = new Receiver([
            'name' => $request->get('name'),
            'mobile_number' => $request->get('mobile_number'),
            'whatsapp_number' => $request->get('whatsapp_number'),
            'address' => $request->get('address'),
        ]);  
        $receiver->save();
        return redirect()->route('receiver_list.index')->with('success', 'Receiver Added Successfully!');
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
        $receiver = Receiver::find($id); 
        return view('admin.receiver.edit',compact('receiver'));
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
            'mobile_number'=>'required|numeric',
            'whatsapp_number'=>'nullable|numeric',
            'address'=>'nullable|string',
    ]);

       $receiver = Receiver::find($id);
       $receiver->name =  $request->get('name');
       $receiver->mobile_number =  $request->get('mobile_number');
       $receiver->whatsapp_number =  $request->get('whatsapp_number');
       $receiver->address =  $request->get('address');
       $receiver->save();

       return redirect()->route('receiver_list.index')->with('success', 'Receiver updated!');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        

        $receiver = Receiver::find($id);
        $receiver->delete();
        return redirect()->route('receiver_list.index')->with('success', 'Receiver deleted!');
    }
}
