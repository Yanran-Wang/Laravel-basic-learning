<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckAge;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::view('/', "welcome");


Route::get('/greeting', function () {
    return 'Hello World';
});

Route::match(['get', 'post'], '/testmatch', function() {
    return "Success";
});

Route::get('/user', function(Request $request){
    $user = [
        ['name' => "John Smith"]
    ];
    return response()->json(['user' => $user]);
});

Route::get('/user/{name?}', function($name = null) {
    return $name;
})->whereAlpha('name');

Route::middleware([CheckAge::class])->group(function () {
    Route::get('/userCheck/16', function () {
        return "not welcome";
    });

    Route::get('/userCheck/{age?}', function () {
        return "welcome";
    });
});

$current_route = Route::current();


