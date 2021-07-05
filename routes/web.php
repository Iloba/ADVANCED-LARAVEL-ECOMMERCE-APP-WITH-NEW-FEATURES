<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//My Routes Begin

//Store Product
Route::post('/addProducts', [ProductController::class, 'create'])->name('add_products');

//Get all Producst
Route::get('myproducts', [ProductController::class, 'allproducts'])->name('myproducts');

//Get All Products by User
ROute::get('/', [ProductController::class, 'getAll'])->name('all_products');

//Edit Product
Route::get('/edit/{product}', [ProductController::class, 'edit_product'])->name('edit_product');

//Update Products
Route::put('/edit/{product}/update', [ProductController::class, 'update_product'])->name('update_products');

//Delete Product
Route::delete('/delete/{id}', [ProductController::class, 'delete_product'])->name('delete_product');

//Add to Cart
Route::post('addtoCart', [ProductController::class, 'addToCart'])->name('add_to_cart');

//Register Customers
Route::view('/registerCustomer', 'customers.register')->name('register_customers');

//Login Customers
Route::view('/loginCustomer', 'customers.login')->name('login_customers');

//Create Customer
Route::post('/createCustomer', [CustomerController::class, 'register'])->name('create_customer');

//login Customer
Route::post('/loginCustomer', [CustomerController::class, 'login'])->name('signin_customer');

//Logout Customer
Route::post('/logoutCustomer', [CustomerController::class, 'logout'])->name('logout_customer');

//cart Page
Route::get('cartItems', [ProductController::class, 'cartItems'])->name('get_cart_items');

//Remove item from Cart
Route::post('remove/{id}', [ProductController::class, 'remove'])->name('remove_from_cart');

//Orders Page
Route::get('orders', [ProductController::class, 'orderItems'])->name('order');

//place order
Route::post('placeOrder', [ProductController::class, 'placeOrder'])->name('place_order');

//Track my orde
Route::get('trackOrder', [ProductController::class, 'trackOrder'])->name('track_my_orders');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

