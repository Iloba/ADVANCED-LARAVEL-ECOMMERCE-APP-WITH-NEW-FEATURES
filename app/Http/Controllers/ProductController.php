<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
            'product_image' => 'required'
       ]);
       
       
       //Upload image
       if($request->hasFile('product_image')){

        //Get Original Name
        $originalName = $request->product_image->getClientOriginalName();


        //store image
       $store =  $request->product_image->storeAs('products', $originalName, 'public'); 

        // if($store){
        //     return redirect()->route('home')->with('status', 'Photo Updated')
        // }

       }


       //Save Data to Database
       $product = new Product;
       $product->name = $request->product_name;
       $product->price = $request->product_price;
       $product->category = $request->product_category;
       $product->description = $request->product_description;
       $product->image = $originalName;

       $product->save();


       //Redirect back with message
       return redirect()->back()->with('status', 'Product added successfully');


    }
}
