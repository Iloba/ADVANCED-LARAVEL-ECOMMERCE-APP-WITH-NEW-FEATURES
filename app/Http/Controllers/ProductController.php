<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //create Posts 
    public function create(Request $request){
        
       //Validate Form
       $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'product_category' => 'required',
            'product_description' => 'required',
            'image' => 'required'
       ]);
       
       
       //Upload image


       //Save Data to Database


       //Redirect back with message


    }
}
