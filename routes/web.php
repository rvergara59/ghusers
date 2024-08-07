<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GhuserController;

Route::get('/getusers/{ghu}', [GhuserController::class,'fetchGitHubUsers']);

Route::get('/', function () {
    return view('welcome');
});
