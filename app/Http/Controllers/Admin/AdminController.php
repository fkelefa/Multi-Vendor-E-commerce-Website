<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        //echo $password = Hash::make('123456');
        if ($request->isMethod('post')) {
            $data = $request->all();
            /* echo "<pre>";
            print_r($data);
            die; */

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email Or Password');
            }
        }

        return view('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
