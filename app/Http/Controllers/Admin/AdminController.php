<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function adminLoginForm()
    {
        return view('backend.admin.login');
    }
   
    
    public function adminLogin(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email' ,
            'password' => 'required'
        ]);
    
        // Attempt to retrieve the admin user with the provided email
        $admin = Admin::where('email', $request->email )->first();

        if ($admin) {
            if (Hash::check($request->password, $admin->password)) {
                // Redirect the user to the admin dashboard
                return redirect('/admin/dashboard');
            } else {
                return redirect()->back()->with('error', 'Invalid Email or Password');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid Email or Password');
        }
    

    }

    public function adminDasboard()
    {
        return view('backend.home.index');
    }

    public function Logout()
    {          
            session()->flush('email');
            return redirect('/admin/login');
    }
    
        
    
}
