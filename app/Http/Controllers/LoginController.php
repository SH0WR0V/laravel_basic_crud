<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class LoginController extends Controller
{
    public function registration(){
        return view('registration');
    }
    public function registerUser(Request $request){
        $request->validate([
          'name'=>'required',
          'email'=>'required|email|unique:users',
          'phone'=>'required',
          'password'=>'required|min:3|max:12',
        ]);
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->password = $request->password;
        $res = $admin->save();
        if($res){
            return back()->with('success','You have registered successfully');
        }else{
            return back()->with('fail', 'Something Went Wrong');
        }
    }

    public function Login(){
        return view('login');
    }
    public function loginSubmit(Request $request){
        $admin = Admin::where('email',$request->email)
                            ->where('password',$request->password)
                            ->first();

        // return $teacher;
        if($admin){
            $request->session()->put('user',$admin->name);
            return redirect()->route('adminDash');
        }
        return back();
    }
    public function logout(){
        session()->forget('user');
        return redirect()->route('login');
    }
}
