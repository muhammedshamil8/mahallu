<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Shop;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:shops-list|shops-create|shops-edit|shops-delete', ['only' => ['index','store']]);
         $this->middleware('permission:shops-create', ['only' => ['create','store']]);
         $this->middleware('permission:shops-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:shops-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $shops = Shop::all();
        return view('admin.shop.index',compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shop.create');
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
        $shop = new Shop([
            'name' => $request->get('name'),
            'mobile_number' => $request->get('mobile_number'),
            'whatsapp_number' => $request->get('whatsapp_number'),
            'address' => $request->get('address'),
        ]);
        $shop->save();
        return redirect()->route('shops.index')->with('success', 'Shop Added Successfully!');
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
        $shop = Shop::find($id);
        return view('admin.shop.edit',compact('shop'));
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

        $shop = Shop::find($id);
        $shop->name =  $request->get('name');
        $shop->mobile_number =  $request->get('mobile_number');
        $shop->whatsapp_number =  $request->get('whatsapp_number');
        $shop->address =  $request->get('address');
        $shop->save();

        return redirect()->route('shops.index')->with('success', 'Shop updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::find($id);
        $shop->delete();
        return redirect()->route('shops.index')->with('success', 'Shop deleted Successfully!!');
    }
}
