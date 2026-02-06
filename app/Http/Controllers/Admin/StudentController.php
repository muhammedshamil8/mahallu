<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Course;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:students-list|students-create|students-edit|students-delete', ['only' => ['index','store']]);
         $this->middleware('permission:students-create', ['only' => ['create','store']]);
         $this->middleware('permission:students-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:students-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $students = Student::all();
        return view('admin.student.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Course::all();
        return view('admin.student.create',compact('classes'));
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
            'whatsapp_number'=>'required|numeric',
            'father_name'=>'required',
            'father_mobile_number'=>'nullable|numeric',
            'father_whatsapp_number'=>'nullable|numeric',
            'mother_name'=>'required',
            'mother_mobile_number'=>'nullable|numeric',
            'mother_whatsapp_number'=>'nullable|numeric',
            'year'=>'required',
            'month'=>'required',
            'day'=>'required',
            'gender'=>'required',
            'fee'=>'nullable|numeric',
            'class'=>'required',
            'address'=>'nullable|string',
            'description'=>'nullable|string',
        ]);
        $year =$request->get('year');
        $month =$request->get('month');
        $day =$request->get('day');
        $student = new Student([
            'name' => $request->get('name'),
            'mobile_number' => $request->get('mobile_number'),
            'whatsapp_number' => $request->get('whatsapp_number'),
            'father_name' => $request->get('father_name'),
            'father_mobile_number' => $request->get('father_mobile_number'),
            'father_whatsapp_number' => $request->get('father_whatsapp_number'),
            'mother_name' => $request->get('mother_name'),
            'mother_mobile_number' => $request->get('mother_mobile_number'),
            'mother_whatsapp_number' => $request->get('mother_whatsapp_number'),
            'dob' => $year.'-'.$month.'-'.$day,
            'gender' => $request->get('gender'),
            'fee' => $request->get('fee'),
            'class_id' => $request->get('class'),
            'address' => $request->get('address'),
            'description' => $request->get('description'),
        ]);
        $student->save();
        return redirect()->route('students.index')->with('success', 'Student Added Successfully!');
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
        $student = Student::find($id);
        $classes = Course::all();
        $date_of_birth=explode('-',$student->dob); 
        $year = $date_of_birth[0];
        $month = $date_of_birth[1];
        $day = $date_of_birth[2];
        return view('admin.student.edit',compact('student','classes','year','month','day'));
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
            'whatsapp_number'=>'required|numeric',
            'father_name'=>'required',
            'father_mobile_number'=>'nullable|numeric',
            'father_whatsapp_number'=>'nullable|numeric',
            'mother_name'=>'required',
            'mother_mobile_number'=>'nullable|numeric',
            'mother_whatsapp_number'=>'nullable|numeric',
            'year'=>'required',
            'month'=>'required',
            'day'=>'required',
            'gender'=>'required',
            'fee'=>'nullable|numeric',
            'class'=>'required',
            'address'=>'nullable|string',
            'description'=>'nullable|string',
            ]);

        $year =$request->get('year');
        $month =$request->get('month');
        $day =$request->get('day');

        $student = Student::find($id);
        $student->name =  $request->get('name');
        $student->mobile_number =  $request->get('mobile_number');
        $student->whatsapp_number =  $request->get('whatsapp_number');
        $student->father_name =  $request->get('father_name');
        $student->father_mobile_number =  $request->get('father_mobile_number');
        $student->father_whatsapp_number =  $request->get('father_whatsapp_number');
        $student->mother_name =  $request->get('mother_name');
        $student->mother_mobile_number =  $request->get('mother_mobile_number');
        $student->mother_whatsapp_number =  $request->get('mother_whatsapp_number');
        $student->dob = $year.'-'.$month.'-'.$day;
        $student->gender =  $request->get('gender');
        $student->fee =  $request->get('fee');
        $student->class_id =  $request->get('class');
        $student->address =  $request->get('address');
        $student->description =  $request->get('description');
        $student->save();

        return redirect()->route('students.index')->with('success', 'Student updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted Successfully!!');
    }
}
