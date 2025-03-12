<?php

use App\Http\Controllers\MyClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(MyClientController::class)->prefix("clients")->group(function () {
    Route::get("/", "index");
    Route::post("/", "store");
    Route::get("/{model:slug}", "show");
    Route::put("/{model:slug}", "update");
    Route::delete("/{model:slug}", "delete");
});
