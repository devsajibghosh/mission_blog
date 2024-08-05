<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TagController;
use App\Models\Blog;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// profile controller
Route::get('/profile',[ProfileController::class,'profile'])->name('profile');

Route::post('/profile/name/update/{id}',[ProfileController::class,'name_update'])->name('name.update');
Route::post('/profile/email/update/{id}',[ProfileController::class,'email_update'])->name('email.update');
Route::post('/profile/password/update/{id}',[ProfileController::class,'password_update'])->name('password.update');
Route::post('/profile/image/update/{id}',[ProfileController::class,'image_update'])->name('image.update');

// category area

Route::get('/category',[CategoryController::class,'category'])->name('category');
Route::post('/category/insert',[CategoryController::class,'category_insert'])->name('category.insert');
Route::post('/category/delete/{id}',[CategoryController::class,'category_delete'])->name('category.delete');
Route::post('/category/status/{id}',[CategoryController::class,'category_status'])->name('category.status');
Route::get('/category/edit/{slug}',[CategoryController::class,'category_edit'])->name('category.edit');
Route::post('/category/edit/update/{id}',[CategoryController::class,'category_edit_update'])->name('category.edit.update');


// Tags area

Route::get('/tag',[TagController::class,'index'])->name('tag');
// insert tag
Route::post('/tag/insert',[TagController::class,'tag_insert'])->name('tag.insert');
Route::get('/tag/edit/{title}',[TagController::class,'tag_edit'])->name('tag.edit');
Route::post('/tag/edit/update/{id}', [TagController::class, 'tag_edit_update'])->name('tag.update');
Route::post('/tag/edit/delete/{id}', [TagController::class, 'tag_edit_delete'])->name('tag.delete');
Route::post('/tag/edit/restore/{id}', [TagController::class, 'tag_edit_restore'])->name('tag.restore');
Route::post('/tag/edit/forcedelete/{id}', [TagController::class, 'tag_edit_forcedelete'])->name('tag.forcedelete');
Route::post('/tag/edit/status/{id}', [TagController::class, 'tag_edit_status'])->name('tag.status');


// blogs area

Route::get('/blog',[BlogController::class,'index'])->name('blog');
Route::get('/blog/create',[BlogController::class,'blog_create'])->name('blog.create');
Route::post('/blog/main/create',[BlogController::class,'create'])->name('blog.new.create');
Route::post('/blog/main/delete/{id}',[BlogController::class,'delete'])->name('blog.new.delete');
Route::post('/blog/main/restore/{id}',[BlogController::class,'restore'])->name('blog.new.restore');
Route::post('/blog/main/forcedelete/{id}',[BlogController::class,'forcedelete'])->name('blog.new.forcedelete');
Route::post('/blog/main/status/{id}',[BlogController::class,'status'])->name('blog.new.status');
// blog edit
Route::get('/blog/edit/{id}',[BlogController::class,'edit_blog'])->name('blog.edit');
Route::post('/blog/edit/{id}',[BlogController::class,'edit'])->name('blog.edit');














