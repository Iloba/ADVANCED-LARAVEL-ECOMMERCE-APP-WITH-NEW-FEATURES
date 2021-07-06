<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
            'price' => number_format($request->product_price),
            'category' => $request->product_category,
            'description' => $request->product_description,
            'image' => $originalName
      ]);


       //Redirect back with message
       return redirect()->back()->with('status', 'Product added successfully');


    }

    //Get all Products
    public function allproducts(){

        $products = Product::latest()->with(['user', 'products'])->paginate(10);

        return view('pages.products', [
            'products' => $products
        ]);
    }


    //Get all Products with user
    public function getAll(){
        //get all posts with Eager loading
        $products = Product::latest()->with(['user', 'products' ])->paginate(5);
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
   public function addToCart(Request $request, Cart $cart){
        
    

       
        //check if user is logged in
        if($request->session()->has('customer')){
            
        //check if item is already added to cart{
            if(DB::table('carts')
            ->where('product_id', '=', $request->product_id)
            ->where('user_id', '=', $request->session()->get('customer')->id)
            ->exists()
            ){
                return redirect()->back()->with('error', 'Product Already in Cart');
            }
     
           
        //Add to cart
        $cart = new Cart;
        $cart->product_id = $request->product_id;
        $cart->user_id = $request->session()->get('customer')->id;

        $cart->save();


        //Redirect Back
        return redirect()->back()->with('status', 'Product added to Cart');

        }else{
            return redirect()->route('login_customers')->with('error', 'Please Sign to continue');
        }

     }

     //get all items in the cart
     public function cartItems(){
         
         //check if user is logged in
         if(Session::has('customer')){
            
          //get the user in which we are getting cart items
          $user = Session::get('customer')->id;

        //get items from database using joins
        $products = DB::table('carts')
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->where('carts.user_id', $user)
        ->select('products.*')
        ->get();

        //Pass cart items to view
        return view('customers.cart',[
            'products' => $products
        ]);

        }else{
            return  redirect()->route('all_products')->with('error', 'Please Sign in to continue');
        }
       
     }

     //Get the Count of items in cart
     static function cartCount(){
         //get user id
         $userId = Session::get('customer')->id;

         //get Count where user id matches $userId
         return Cart::where('user_id', $userId)->count();
     }


     //Remove item from cart
     public function remove($id){

        $product = Cart::where('product_id', $id)->first();
 
        $product->delete();

        return back()->with('status', 'Product Removed from cart');
     }

     //Order items
     public function orderItems(Request $request){
        //Get user id
        $userId = $request->session()->get('customer')->id;
       
        //get Data from Database Using join and sum them
        $total = DB::table('carts')
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->where('carts.user_id', $userId)
        ->select('products.*')
        ->sum('products.price');

        

        
      

        return view('customers.orders',[
            'total' => $total
        ]);
     }


     //place order
     public function placeOrder(Request $request){
        //Validate request
        $request->validate([
            'address' => 'required',
            'payment_method' => 'required'
        ]);

        //Get user id
        $userId = Session::get('customer')->id;
       
        //Get all items from the cart
        $allitems = Cart::where('user_id', $userId)->get();
       
        //store items in the orders table(By looping through them)
        foreach($allitems as $items){
            $order = new Order;
            $order->product_id = $items->product_id;
            $order->user_id = $items->user_id;
            $order->status = 'Pending';
            $order->payment_method = $request->payment_method;
            $order->payment_status = 'Pending';
            $order->address = $request->address;

            $order->save();

            //Clear cart
            $allitems = Cart::where('user_id', $userId)->delete();
        }

        return redirect()->route('all_products')->with('status', 'Order Placed Successfuly');
     }

     //Track my order
     public function trackOrder(){
         //Get user id
         $userId = Session::get('customer')->id;
      
         //Get all data from order items using User id
         $products = DB::table('orders')
         ->join('products', 'orders.product_id', '=', 'products.id')
         ->where('orders.user_id', $userId)
         ->get();

         return view('customers.track_order', [
             'products' => $products
         ]);
     }

     //Get count of orders
     static function orderCount(){
         //get User id
         $user = Session::get('customer')->id;

        return $ordercount = Order::where('user_id', $user)->count();
     }


}
