<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('{/vue_capture?}',function(){ return view('welcome'); })->where('vue_capture','[\/\w\.-]*');
















































