<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
Route::get('/coupons/{id}', [CouponController::class, 'show'])->name('coupons.show');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/reviews', function () {
    return view('reviews.index');
})->name('reviews.index');
Route::get('/about-us', function () {
    return view('about-us.index');
})->name('about-us.index');
Route::get('/contact-us', function () {
    return view('contact-us.index');
})->name('contact-us.index');



