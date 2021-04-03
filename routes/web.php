<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Contributor\ContributorController;

Route::get('/', [HomeController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('access/denied', function () {
    return view('access.denied');
})->name('404.permission');

Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('is_admin');
Route::get('admin/category/index', [CategoryController::class, 'index'])->name('admin.category.index')->middleware('is_admin');
Route::post('admin/category/destroy', [CategoryController::class, 'destroy'])->name('admin.category.destroy')->middleware('is_admin');
Route::get('admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create')->middleware('is_admin');
Route::post('admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store')->middleware('is_admin');
Route::get('admin/category/show/{slug?}', [CategoryController::class, 'show'])->name('admin.category.show')->middleware('is_admin');
Route::get('admin/category/edit/{slug?}', [CategoryController::class, 'edit'])->name('admin.category.edit')->middleware('is_admin');
Route::post('admin/category/update', [CategoryController::class, 'update'])->name('admin.category.update')->middleware('is_admin');

Route::resource('posts', PostController::class)->middleware('is_admin');
Route::resource('users', USerController::class)->middleware('is_admin');

Route::get('/contributor/edit/password', [ContributorController::class, 'editpassword'])->name('contributor.editpassword');
Route::post('/contributor/update/password', [ContributorController::class, 'update'])->name('contributor.update');
Route::get('/contributor/show/profile', [ContributorController::class, 'showprofile'])->name('contributor.showprofile');
Route::get('/contributor/post/manage', [ContributorController::class, 'postmanage'])->name('contributor.post.manage');
Route::get('/contributor/post/create', [ContributorController::class, 'postcreate'])->name('contributor.post.create');
Route::post('/contributor/post/store', [ContributorController::class, 'poststore'])->name('contributor.post.store');
Route::post('/contributor/post/destroy', [ContributorController::class, 'postdestroy'])->name('contributor.post.destroy');
Route::get('/contributor/post/show{id}', [ContributorController::class, 'postshow'])->name('contributor.post.show');
Route::get('/contributor/post/edit{id}', [ContributorController::class, 'postedit'])->name('contributor.post.edit');
Route::post('/contributor/post/update', [ContributorController::class, 'postupdate'])->name('contributor.post.update');