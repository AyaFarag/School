<?php

use Illuminate\Http\Request;

//===============================================================
//
// API DOCUMENTATION
//
//===============================================================

Route::get("/docs", function (Request $request) {
    $documentation = new \App\Supports\ApiDocumentation();
    $endpoints = $documentation -> all($request -> input("categories"));
    return view("api-documentation.endpoints", compact("endpoints"));
}) -> name("apidocs");

Route::get("/docs/endpoint", function (Request $request) {
    $documentation = new \App\Supports\ApiDocumentation();
    $endpoint = $documentation -> get($request -> input("route"), $request -> input("method"));
    return view("api-documentation.endpoint", compact("endpoint"));
}) -> name("apidocs.endpoint");
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
