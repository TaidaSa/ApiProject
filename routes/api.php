<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;


//Puplic Routes

Route::get("products", "ProductController@index");
Route::get("products/{id}", "ProductController@show"); 

//Registretion Route

Route::post("login", "AuthController@login");
Route::post("register", "AuthController@register");



//Private Routes

Route::group(["middleware" => ['auth:sanctum']], function() {

    Route::post("products", "ProductController@store");
    Route::put("products/{id}", "ProductController@update");
    Route::delete("products/{id}", "ProductController@destroy");
    Route::post("/logout", "AuthController@logout");
     
});




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
