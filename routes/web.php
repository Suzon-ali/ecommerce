<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\FrontEnd\FrontendController;
use App\Models\Brand;
use Illuminate\Support\Facades\Route;

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

//CartController
Route::post('/add/to/cart',[CartController::class,'addToCart']);
Route::get('/checkout',[CartController::class,'checkOut']);
Route::get('/cart/product/delete/{id}',[CartController::class,'cartDelete']);
Route::post('/cart/product/update/{id}',[CartController::class,'updateQTY']);

//FrontendController
Route::get('/',[FrontendController::class, 'index']);
Route::get('/admin/login',[AdminController::class, 'adminLoginForm']);
Route::post('/admin/login',[AdminController::class, 'adminLogin']);
Route::get('/admin/dashboard',[AdminController::class, 'adminDasboard']);

//Logout Controller

Route::get('/logout',[AdminController::class,'Logout']);

//CategoryController
Route::get('/category/add', [CategoryController::class, 'showCatergoryForm']);
Route::post('/category/store', [CategoryController::class, 'categoryStore']);
Route::get('/category/manage', [CategoryController::class, 'categoryManage']);
Route::get('/category/edit/{id}', [CategoryController::class, 'categoryEdit']);
Route::post('/category/update/{id}', [CategoryController::class, 'categoryUpdate']);
Route::get('/category/inactive/{id}', [CategoryController::class, 'categoryInactive']);
Route::get('/category/active/{id}', [CategoryController::class, 'categoryActive']);
Route::get('/category/delete/{id}', [CategoryController::class, 'categoryDelete']);

//BrandController

Route::get('/brand/add', [BrandController::class, 'showBrandForm']);
Route::post('/brand/store', [BrandController::class, 'brandStore']);
Route::get('/brand/manage', [BrandController::class, 'brandManage']);
Route::get('/brand/edit/{id}', [BrandController::class, 'brandEdit']);
Route::post('/brand/update/{id}', [BrandController::class, 'brandUpdate']);
Route::get('/brand/inactive/{id}', [BrandController::class, 'brandInactive']);
Route::get('/brand/active/{id}', [BrandController::class, 'brandActive']);
Route::get('/brand/delete/{id}', [BrandController::class, 'brandDelete']);

//ProductController
Route::get('/product/add', [ProductController::class, 'showProductForm']);
Route::get('/product/manage', [ProductController::class, 'productManage']);
Route::post('/product/store', [ProductController::class, 'productStore']);
Route::get('/edit/{id}', [ProductController::class, 'productEdit']);
Route::post('/product/update/{id}', [ProductController::class, 'productUpdate']);
Route::get('/product/active/{id}', [ProductController::class, 'productActive']);
Route::get('/product/inactive/{id}', [ProductController::class, 'productInactive']);
Route::get('/product/delete/{id}', [ProductController::class, 'productDelete']);
Route::get('/delete/image/{id}', [ProductController::class, 'deleteProductImage']);

