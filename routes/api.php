<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

#methode get
Route::get('/animals', [AnimalController::class, 'index']);


#methode post
Route::post('/animals', [AnimalController::class, 'store']);
#methode put
Route::put('/animals/{id}', [AnimalController::class, 'update']);

#methode delete
Route::delete('/animals/{id}', [AnimalController::class, 'destroy']);


Route::middleware(['auth:sanctum'])->group(function()
{
    #membuat route students dengan methode get
    Route::get('/students', [StudentController::class, 'index']);
    #membuat route students dengan methode post
    Route::post('/students', [StudentController::class, 'store']);
    #methode put
    Route::put('/students/{id}', [StudentController::class, 'update']);
    #methode delete
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);
    #methode get
    Route::get('/students/{id}', [StudentController::class, 'show']);
});

#membuat route untuk register dan login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

# membuat route middleware(otentikasi) dan menggabungkan route lainnya ke dalam group
# agar ter-autentikasi
Route::middleware(['auth:sanctum'])->group(function()
{
# membuat route patients dengan method get
Route::get('/patients', [PatientController::class, 'index']);
#membuat route patients dengan method post
Route::post('/patients', [PatientController::class, 'store']);
# membuat route patients dengan method get dengan parameter id
Route::get('/patients/{id}', [PatientController::class, 'show']);
# membuat route patients dengan method put untuk mengubah data
Route::put('/patients/{id}', [PatientController::class, 'update']);
# membuat route patients dengan method delete untuk menghapus data
Route::delete('/patients/{id}', [PatientController::class, 'destroy']);
# membuat route search dengan parameter name dan method get untuk mencari data
Route::get('/patients/search/{name}', [PatientController::class, 'search']);
# membuat route search dengan end point positive dan method get untuk mencari data
Route::get('/patients/status/positive', [PatientController::class, 'positive']);
# membuat route search dengan end point recovered dan method get untuk mencari data
Route::get('/patients/status/recovered', [PatientController::class, 'recovered']);
# membuat route search dengan end point dead dan method get untuk mencari data
Route::get('/patients/status/dead', [PatientController::class, 'dead']);
});