<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserAPI\ShoppingUserController;
use App\Http\Controllers\UserAPI\ShowOneCategory;
use App\Http\Controllers\UserAPI\UserCategoriesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){


Route::get('/', function () {
    return view('welcome');
})->name("welcomepage");

Route::get('/categoryUser', [UserCategoriesController::class, 'showCategoriesPage'])->name('categoryuser');

Route::get('/showOneCategory/{id}', function($id) { 
	return view('showonecategory' , ['categoryID' => $id]);
})->name('showonecategory');

Route::get('/showOneProduct/{id}', function($id) { 
	return view('showoneproduct' , ['productID' => $id]);
})->name('showoneproduct');
//add to cart
Route::post('/cart/add', 'CartController@add')->name('cart.add');
//remove from the cart
Route::post('/cart/remove', 'CartController@remove')->name('cart.remove');
//update quntity
Route::post('/cart/update', 'CartController@update')->name('cart.update');


Route::get('/shoppingUser', [ShoppingUserController::class, 'showAllProducts'])->name('shoppinguser');


Auth::routes();

Route::group(["middleware"=>"CheckAdmin"],function(){

//users
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/show/{id}',"HomeController@show")->name('showUser');
Route::delete('/users/{cat_id}', [HomeController::class, 'delete'])->name('deleteUser');
Route::get('/users/create',"HomeController@create")->name('createuser');
Route::post('/users/store',"HomeController@store")->name('storeUser');
Route::get('/users/edit/{id}',"HomeController@edit")->name('editUser');
Route::put('/users/updatestore/{id}',"HomeController@updatestore")->name('updateUser');

//categories
Route::get('/categories/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/show/{cat_id}',"CategoryController@show")->name('showCategory');
Route::delete('/categories/{cat_id}', [CategoryController::class, 'delete'])->name('deleteCategory');
Route::get('/categories/create','CategoryController@create')->name('createcategory');
Route::post('/categories/store','CategoryController@store')->name('storeCategory');
Route::get('/categories/edit/{cat_id}',"CategoryController@edit")->name('editCategory');
Route::put('/categories/updatestore/{cat_id}',"CategoryController@updatestore")->name('updateCategory');




//products
Route::get('/products/products', 'ProductController@index')->name('products');
Route::get('/products/show/{pro_id}',"ProductController@show")->name('showProduct');
Route::delete('/products/{pro_id}', [ProductController::class, 'delete'])->name('deleteProduct');
Route::get('/products/create','ProductController@create')->name('createproduct');
Route::post('/products/store','ProductController@store')->name('storeProduct');
Route::get('/products/edit/{pro_id}',"ProductController@edit")->name('editProduct');
Route::put('/products/updatestore/{pro_id}',"ProductController@updatestore")->name('updateProduct');

});
});

