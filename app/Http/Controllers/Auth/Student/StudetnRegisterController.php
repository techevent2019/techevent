<?php

namespace App\Http\Controllers\Auth\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Student;

class StudetnRegisterController extends Controller
{
    public function create()
    {
        return view('auth/student-register');
    }



    public function store(Request $request)
    {
    	$this->validation($request);
    	//print_r($request->input());

        //Student::create($request->all()); //for store all data at once
        Student::create([
        	'stu_name' => $request['stu_name'],
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'stu_enrollment_no' => $request['stu_enrollment_no'],
            'stu_con_no' => $request['stu_con_no'],
            'stu_department' => $request['stu_department'],
            'stu_col_code' => $request['stu_col_code'],
            'stu_col_name' => $request['stu_col_name'],
            'stu_gender' => $request['stu_gender'],
            'stu_sem' => $request['stu_sem'],
        ]);
        
        return redirect()->intended(route('student.index'));
        
    }

    public function validation($request)
    {
    	return $this->validate($request, [
    		'stu_name' => 'required|min:2|max:50',

            'email' => 'required|email|unique:students',

            'password' => 'required|min:8|confirmed',

            'stu_enrollment_no' => 'required|min:12|numeric|unique:students',

            'stu_con_no' => 'required|min:10|numeric',

            'stu_department' => 'required',

            'stu_col_code' => 'required|numeric|min:4',

            'stu_col_name' => 'required',

            'stu_gender' => 'required',

            'stu_sem' => 'required',
    	]);
    }
}
