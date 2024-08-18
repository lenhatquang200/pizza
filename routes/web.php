<?php
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
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
Route::get('/', function () {
    return view('layouts/app');
});
// Route::get('/custom-admin', function () {
//     return view('admin.dashboard');
// });
// Route::get('/admin/uploadsphoto', [AdminController::class, 'uploadsPhoto'])->name('admin.uploadsphoto');
// Route::post('/admin/uploadsphoto', [AdminController::class, 'storeUploadPhoto'])->name('admin.uploadsphoto.store');

