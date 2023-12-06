<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckAge;
use App\Http\Controllers\profileController;
use App\Models\Flight;

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

Route::get('/user/{id}', [profileController::class, 'show']);

# try to add data
Route::get('/add_flight', function(){
    $flight = new Flight();
    $flight->Name = "Sydney to London";
    $flight->flight_id = 1;
    $flight->options = "test";
    $flight->delayed = 0;
    $flight->updated_at = 10;
    $flight->created_at = 10;
    $flight->save();

    return "Flight created";
});

Route::get('/flights', function(){
    foreach (Flight::all() as $flight) {
        echo $flight->Name;
    }
});


