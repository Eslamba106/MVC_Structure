<?php

use Core\Http\Route;
use App\Controllers\HomeController;


Route::get('/' , 'HomeController@index');
// Route::get('/' , function (){
//     echo "Hello";
// });