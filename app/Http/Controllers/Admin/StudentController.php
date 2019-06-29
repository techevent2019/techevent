<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ss = $request->input('ss');

        $students = Student::latest()
            ->search($ss)
            ->paginate(10);
        return view('admin.student.index', compact('students', 'ss'));
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
        //
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
        $students = Student::find($id);
        return view('admin.student.edit',compact('students', 'id'));
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
        $this->validate($request, [
            'stu_name' => 'required|min:2|max:50',

            'email' => "required|email|unique:students,email,$id" ,

            'stu_enrollment_no' => "required|min:12|numeric|unique:students,stu_enrollment_no,$id",

            'stu_con_no' => 'required|min:10|numeric',

            'stu_department' => 'required',

            'stu_col_code' => 'required|numeric|min:4',

            'stu_col_name' => 'required',

            'stu_gender' => 'required',

            'stu_sem' => 'required',
        ]);

        $students = Student::find($id);
        $students->stu_name  = $request->input('stu_name');
        $students->email  = $request->input('email');
        $students->stu_enrollment_no  = $request->input('stu_enrollment_no');
        $students->stu_con_no  = $request->input('stu_con_no');
        $students->stu_department  = $request->input('stu_department');
        $students->stu_col_code  = $request->input('stu_col_code');
        $students->stu_col_name  = $request->input('stu_col_name');
        $students->stu_gender  = $request->input('stu_gender');
        $students->stu_sem  = $request->input('stu_sem');

        $students ->save();

        return redirect()->route('admin.student.index')->with('success', 'student Updated.');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $students = Student::find($id);
        $students->delete();

        return redirect()->route('admin.student.index')->with('success','student Delete');
    }
}
