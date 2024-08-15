<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FrontBlogsController;
use App\Http\Controllers\FrontCategoryBlogController;
use App\Http\Controllers\FrontContactController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\FrontTagBlogsController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SearchController;
use App\Models\Blog;
use App\Models\ContactController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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


Auth::routes([ 'register' => false ]);



// frontend controller
Route::get('/', [App\Http\Controllers\FrontendController::class, 'index_home'])->name('index.home');

// contact controller
Route::get('/contact/page',[FrontContactController::class,'contact_view'])->name('contact.view');
Route::post('/contact/post',[FrontContactController::class,'contact_post'])->name('contact.post');



//frontend tag blog controller
Route::get('/root/category/blog/{id}',[FrontCategoryBlogController::class,'category_blogs'])->name('root.category.blogs');
Route::get('/root/category/single/blog/post/{id}',[FrontCategoryBlogController::class,'single_blogs'])->name('single.blog.post');
// when click the tag go to same related post
Route::get('/root/tag/blog/post/{id}',[FrontTagBlogsController::class,'tag_blog_post'])->name('tag.blog.post');

// FrontBlogsController
Route::get('/root/blogs',[FrontBlogsController::class,'index'])->name('root.blogs');

// search blogs-controller
Route::get('/blogs/search',[SearchController::class,'search'])->name('blogs.search');

// registration controller
Route::get('/author/registration',[RegistrationController::class,'registration'])->name('author.registration');
Route::post('/author/register',[RegistrationController::class,'register'])->name('author.register');
// login matter
Route::get('/author/loginer',[RegistrationController::class,'loginer'])->name('author.loginer');
Route::post('/author/login',[RegistrationController::class,'login'])->name('author.login');

// comments

Route::post('/single/post/comment',[CommentController::class,'insert'])->name('root.comment.post');








// home controller
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
// status accept and reject
Route::get('/home/status/approve/{id}', [App\Http\Controllers\HomeController::class, 'approve'])->name('home.approve.author');
Route::get('/home/status/reject/{id}', [App\Http\Controllers\HomeController::class, 'rejecet'])->name('home.reject.author');
// block author
Route::get('/home/status/block/{id}', [App\Http\Controllers\HomeController::class, 'block'])->name('home.block.author');



// profile controller
Route::get('/profile',[ProfileController::class,'profile'])->name('profile');

Route::post('/profile/name/update/{id}',[ProfileController::class,'name_update'])->name('name.update');
Route::post('/profile/email/update/{id}',[ProfileController::class,'email_update'])->name('email.update');
Route::post('/profile/password/update/{id}',[ProfileController::class,'password_update'])->name('password.update');
Route::post('/profile/image/update/{id}',[ProfileController::class,'image_update'])->name('image.update');

// category area

Route::get('/category',[CategoryController::class,'category'])->middleware('rolecheck')->name('category');
Route::post('/category/insert',[CategoryController::class,'category_insert'])->middleware('rolecheck')->name('category.insert');
Route::post('/category/delete/{id}',[CategoryController::class,'category_delete'])->middleware('rolecheck')->name('category.delete');
Route::post('/category/status/{id}',[CategoryController::class,'category_status'])->middleware('rolecheck')->name('category.status');
Route::get('/category/edit/{slug}',[CategoryController::class,'category_edit'])->middleware('rolecheck')->name('category.edit');
Route::post('/category/edit/update/{id}',[CategoryController::class,'category_edit_update'])->middleware('rolecheck')->name('category.edit.update');


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
Route::get('/blog/feature/{id}',[BlogController::class,'feature'])->middleware('rolecheck')->name('blog.feature');

// role controller

Route::get('/role',[RoleController::class,'role'])->middleware('rolecheck')->name('role.view');
Route::post('/role/modaretor',[RoleController::class,'role_modaretor'])->middleware('rolecheck')->name('role.modaretor');
Route::post('/role/assign',[RoleController::class,'role_assign'])->middleware('rolecheck')->name('role.assign');
// role delete
Route::post('/role/restore/{id}',[RoleController::class,'role_restore'])->name('role.restore');
Route::post('/role/p/delete/{id}',[RoleController::class,'role_forcedelete'])->name('role.forcedelete');
Route::post('/role/delete/{id}',[RoleController::class,'role_at'])->name('role.at');


// email verification

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');




















