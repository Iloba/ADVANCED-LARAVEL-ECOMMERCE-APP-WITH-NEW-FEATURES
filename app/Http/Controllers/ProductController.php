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
      $products = $request->user()->products()->create([
            'name' => $request->product_name,
            'price' => $request->product_price,
            'category' => $request->product_category,
            'description' => $request->product_description,
            'image' => $originalName
      ]);


       //Redirect back with message
       return redirect()->back()->with('status', 'Product added successfully');


    }

    //Get all Products
    public function allproducts(){

        $products = Product::latest()->paginate(5);

        return view('pages.products', [
            'products' => $products
        ]);
    }


    //Get all Products with user
    public function getAll(){
        $products = Product::latest()->paginate(8);
        $latestProducts = Product::latest()->first();
        return view('welcome',[
            'products' => $products,
            'latestProducts' => $latestProducts
        ]);
    }

    

   //Edit Product
   public function edit_product(Product $product){
       return view('pages.edit_product', [
           'product' => $product
       ]);
   }


   //Update Product
   public function update_product(Request $request, Product $product){
       $product = Product::find($product->id);


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

       $product->name = is_null($request->product_name) ? $product->name : $request->product_name;
       $product->price = is_null($request->product_proce) ? $product->price : $request->product_price;
       $product->category = is_null($request->product_category) ? $product->category : $request->product_category;
       $product->description = is_null($request->product_description) ? $product->description : $request->product_description;
       $product->image = is_null($request->product_image) ? $product->image : $originalName;

       $product->save();


       //Return redirect
       return redirect()->back()->with('status', 'Product Updated Successfully');
   }


   //Delete PRoduct
   public function delete_product($id){
    
    $product = Product::find($id);

    $product->delete();

    return redirect()->back()->with('status', 'Product Deleted Successfully');

   }

   //Add to cart
   public function addToCart(){
       return 'hello';
   }



}
