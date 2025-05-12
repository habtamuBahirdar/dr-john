<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
       if(auth::id())
       {
        $usertype = Auth::user()->usertype;

        if($usertype == 'user')
        {
            return view('dashboard');
        }
      else if($usertype == 'admin')
        {
            return view('admin.index');

        }
        
        else if($usertype == 'patient')
        {
            return view('patient.index');

        }
         else if($usertype == 'scheduler')
        {
            return view('scheduler.index');

        }
        else
        {
            return redirect()->back();
        }

    }   
} 
}