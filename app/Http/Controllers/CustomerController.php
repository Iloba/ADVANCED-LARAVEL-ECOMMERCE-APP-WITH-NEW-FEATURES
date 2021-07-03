<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    //register customer
    public function register(Request $request){
       
        //Validate Request
        $request->validate([
            'name' => 'required',
            'email' => 'required | unique:customers',
            'password' => 'required'
        ]);


        //Store customer
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);

        $customer->save();


        //create session and sign user in
        $request->session()->put('customer', $customer);
        return redirect()->route('all_products')->with('status', 'welcome, your registration was successful');
    }
    

    //Login Customer
    public function login(Request $request){
        //Validate Request
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        //Login user

       //Get all customers based on input from the user
        $customer = Customer::where('email', $request->email)->first();

         //Check to see if customer exists
        if($customer){
            //check if password matches
            if(!Hash::check($request->password, $customer->password)){
                return back()->with('error', 'Incorect Password');
            }else{
               

                //Create Session
                $request->session()->put('customer', $customer);
                return redirect()->route('all_products')->with('status', 'Login Successful');
            }
        
        }else{
            return back()->with('error', 'User Does not exist');
        }
    }

    //Logout Customer
    public function logout(){
        Session::forget('customer');
        return redirect()->route('login_customers')->with('status', 'Logout Successful');
    }
}
