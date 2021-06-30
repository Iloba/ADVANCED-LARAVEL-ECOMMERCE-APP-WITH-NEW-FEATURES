<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

