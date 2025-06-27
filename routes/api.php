<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//categories
//show all
Route::get('/alldatacategories','API\CategoryController@index');
//show one
Route::get('/showonecategory/{id}','API\CategoryController@showcategory');
//delete one
Route::post('/deleteonecategory','API\CategoryController@deletecategory');
//store one
Route::post('/storeonecategory','API\CategoryController@storecategory');
//update one
Route::post('/updateonecategory','API\CategoryController@updatecategory');

//products
//show all
Route::get('/alldataproducts','API\ProductController@index');
//show one
Route::get('/showoneproduct/{id}','API\ProductController@showproduct');
//delete one
Route::post('/deleteoneproduct','API\ProductController@deleteproduct');
//store one
Route::post('/storeoneproduct','API\ProductController@storeproduct');
//update one
Route::post('/updateoneproduct','API\ProductController@updateproduct');

//users
//show all
Route::get('/alldatausers','API\UserController@index');
//show one
Route::get('/showoneuser/{id}','API\UserController@showuser');
//delete one
Route::post('/deleteoneuser','API\UserController@deleteuser');
//store one
Route::post('/storeoneuser','API\UserController@storeuser');
//update one
Route::post('/updateoneuser','API\UserController@updateuser');