<?php

use App\Http\Controllers\Webhook\CallbackMidtransController;
use Illuminate\Support\Facades\Route;

Route::post('midtrans/callback',[CallbackMidtransController::class,'callback'])->name('midtrans.callback');