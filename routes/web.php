<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register'=>false]);

Route::get('/{name}', function($name){ 
    return redirect('/');
 })->where('name', '(getfile|getglossary)');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [App\Http\Controllers\ClientController::class, 'index']);
    Route::post('/getglossary', [App\Http\Controllers\ClientController::class, 'getGlossary']);
    Route::post('/getfile', [App\Http\Controllers\ClientController::class, 'getFile']);
});

