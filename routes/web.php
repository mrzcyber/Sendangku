<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.index');
});
Route::get('/layanan', function () {
    return view('front.service');
});
Route::get('/layanan/berkuda', function () {
    return view('front.detail');
});


