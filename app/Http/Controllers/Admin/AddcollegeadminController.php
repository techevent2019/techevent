<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Notification;
use App\Collegeadmin;
use App\Notifications\CollegeadminpasswordNotification;
use DB;

class AddcollegeadminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ss = $request->input('ss');

        $collegeadmins = Collegeadmin::latest()
            ->search($ss)
            ->paginate(10);
        return view('admin.collegeadmin.index', compact('collegeadmins', 'ss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.collegeadmin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
         $this->validation($request);
         $collegeadmin = new Collegeadmin();

         if($request->image->getClientOriginalName())
        {
            $ext = $request->image->getClientOriginalExtension();
            $file = date('YmdHis').rand(1,999999).'.'.$ext;
            $request->image->storeAs('public/colleges',$file);
        }
        else
        {
            $file = '';
        }

        $collegeadmin->col_name  = $request->input('col_name');
        $collegeadmin->email  = $request->input('email');
        $collegeadmin->password  = $request->input('password');
        $collegeadmin->col_address  = $request->input('col_address');
        $collegeadmin->col_address  = $request->input('col_address');
        $collegeadmin->col_con_no  = $request->input('col_con_no');
        $collegeadmin->col_code  = $request->input('col_code');
        $collegeadmin->col_city  = $request->input('col_city');
        $collegeadmin->col_admin_name  = $request->input('col_admin_name');
        $collegeadmin->col_principal_name  = $request->input('col_principal_name');
        $collegeadmin->admin_con_no  = $request->input('admin_con_no');
        $collegeadmin->image  = $file;

        $collegeadmin->save();

        Notification::send($collegeadmin, new CollegeadminpasswordNotification);

        $collegeadmin->password = Hash::make($request->password);
        $collegeadmin->save();

        return redirect()->route('admin.collegeadmin.index')->with('success', 'Successfully Added');
     }

    public function validation($request)
        {
        return $this->validate($request, [
            'col_name' => 'required|min:2|max:50',

            'email' => 'required|email|unique:collegeadmins',

            'password' => 'required|min:8',

            'col_address' => 'required',

            'col_con_no' => 'required|numeric',

            'col_code' => 'required|numeric|min:4|unique:collegeadmins',

            'col_city' => 'required',

            'col_admin_name' => 'required',

            'col_principal_name' => 'required',

            'admin_con_no' => 'required|numeric',
        ]);
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
        $collegeadmin = Collegeadmin::find($id);
        return view('admin.collegeadmin.edit',compact('collegeadmin', 'id'));
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
        $this->validate($request,[
            'col_name' => 'required|min:2|max:50',

            'email' => "required|email|unique:collegeadmins,email,$id",

            'col_address' => 'required',

            'col_con_no' => 'required|numeric',

            'col_code' => "required|numeric|min:4|unique:collegeadmins,col_code,$id",

            'col_city' => 'required',

            'col_admin_name' => 'required',

            'col_principal_name' => 'required',

            'admin_con_no' => 'required|numeric',
        ]);

        $collegeadmins = Collegeadmin::find($id);

        if(isset($request->image) && $request->image->getClientOriginalName())
        {
            $ext = $request->image->getClientOriginalExtension();
            $file = date('YmdHis').rand(1,999999).'.'.$ext;
            $request->image->storeAs('public/colleges',$file);
        }
        else
        {
            if(!$collegeadmins->image)
                $file = '';
            else
                $file = $collegeadmins->image;
        }

        $collegeadmins->col_name = $request->input("col_name");
        $collegeadmins->email = $request->input("email");
        $collegeadmins->col_address = $request->input("col_address");
        $collegeadmins->col_con_no = $request->input("col_con_no");
        $collegeadmins->col_code = $request->input("col_code");
        $collegeadmins->col_city = $request->input("col_city");
        $collegeadmins->col_admin_name  = $request->input('col_admin_name');
        $collegeadmins->col_principal_name  = $request->input('col_principal_name');
        $collegeadmins->admin_con_no  = $request->input('admin_con_no');
        $collegeadmins->image = $file;

        $collegeadmins->save();
        return redirect()->route('admin.collegeadmin.index')->with('success', 'Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Collegeadmin::destroy($id);
        return redirect()->route('admin.collegeadmin.index')->with('success', 'Successfully Deleted.');
    }
}
