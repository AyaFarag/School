<?php

use Illuminate\Http\Request;


//===============================================================
//
// AUTHENTICATION
//
//===============================================================

Route::post("/register", "AuthController@register");
Route::post("/login", "AuthController@login");


Route::group(["middleware" => "auth:api"], function () {
    
    //===============================================================
    //
    // PHONE ACTIVATION
    //
    //===============================================================
    
    Route::group(["prefix" => "activate/phone"], function () {
        Route::post("/send", "AccountController@sendPhoneActivationCode");
        Route::post("/", "AccountController@activatePhone");
    });
    
    Route::post("/parent", "ParentController@login");
    Route::post("/student", "StudentController@login");
    Route::post("/teacher", "TeacherController@login");
});