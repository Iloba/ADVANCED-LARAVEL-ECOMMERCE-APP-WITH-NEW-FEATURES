<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //register customer
    public function register(Request $request){
        return $request->input();
    }
    

    //Login Customer
    public function login(Request $request){
        return 'login';
    }
}
