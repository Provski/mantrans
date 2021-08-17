<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentRepliesController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home.default');
});

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/ourvalues', function () {
    return view('pages.ourvalues');
});

Route::get('/contact', function () {
    return view('pages.contact');
});

Route::get('/team', function () {
    return view('pages.team');
});

Route::get('/service', function () {
    return view('service.comprof');
});

Route::get('/service/project', function () {
    return view('service.project');
});

Route::get('/mantransnetwork', function () {
    return view('service.mantransnetwork');
});

Route::get('/mantransequipment', function () {
    return view('service.mantransequipment');
});

Route::get('/blog', function () {
    return view('blog.show');
});


Route::get('blog/admin', function () {
    auth()->user()->unreadNotifications;
})->middleware(['auth','userStatusAccount'])->name('unreadComment');

Route::get('/markAsReadComment',function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->middleware(['auth','userStatusAccount'])->name('markAsReadComment');




Route::get('blog/admin', function () {
    auth()->user()->unreadNotifications;
})->middleware(['auth','userStatusAccount'])->name('unreadReplied');

Route::get('/markAsReadReplied',function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->middleware(['auth','userStatusAccount'])->name('markAsReadReplied');



Auth::routes(['verify' => true]);

Route::get('blog/show/', [App\Http\Controllers\HomeController::class, 'index'])->name('blog.show');
Route::get('blog/posts/{posts}/{slug}', [App\Http\Controllers\HomeController::class, 'show'])->name('blog.post');

Route::get('blog/authors/{authors}', [App\Http\Controllers\HomeController::class, 'aboutAuthor'])->name('blog.about-author');
Route::get('blog/categories/{categories}', [App\Http\Controllers\HomeController::class, 'category'])->name('blog.category');

 
Route::middleware(['auth', 'userStatusAccount'])->group(function () {
    Route::get('blog/admin', [HomeController::class, 'adminDashboard'])->name('blog.admin');
    Route::get('blog/admin/chart', [HomeController::class, 'chartDashboard'])->middleware('verified')->name('blog.admin.chart');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

});







