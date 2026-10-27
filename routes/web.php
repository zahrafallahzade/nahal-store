<?php

use Illuminate\Support\Facades\Route;

//کنترلر های ادمین
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\ReviewController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\AccountController;


//کنترلر های مدیر
use App\Http\Controllers\manager\ProductController as ManagerProductController;
use App\Http\Controllers\manager\OrderController as ManagerOrderController;
use App\Http\Controllers\manager\UserController as ManagerUserController;
use App\Http\Controllers\manager\RoleController;
use App\Http\Controllers\manager\ReportController;
use App\Http\Controllers\manager\DashboardController;
use App\Http\Controllers\manager\AccountController as ManagerAccountController;


//کنترلر های فروشگاه
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ReviewSubmitController;
use App\Http\Controllers\CartController;


//کنترلر های ورود و ثبت نام
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;




Route::get('/', [HomeController::class, 'index']);


Route::get('/admin' , function(){
    return redirect('/admin/dashboard');
});

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);

Route::get('/admin/products', [ProductController::class, 'index']);

Route::post('/admin/products', [ProductController::class, 'store']);

Route::post('/admin/products/{id}/update', [ProductController::class, 'update']);

Route::post('/admin/products/{id}/delete', [ProductController::class, 'destroy']);

Route::post('/admin/products/{id}/activate', [ProductController::class, 'activate']);

Route::post('/admin/products/images/{id}/delete', [ProductController::class, 'deleteImage']);

Route::get('/admin/categories', [CategoryController::class, 'index']);

Route::post('/admin/categories', [CategoryController::class, 'store']);
Route::post('/admin/categories/{id}/update', [CategoryController::class, 'update']);
Route::post('/admin/categories/{id}/delete', [CategoryController::class, 'destroy']);

Route::get('/admin/orders', [OrderController::class, 'index']);

Route::get('/admin/users', [UserController::class, 'index']);

Route::post('/admin/users/{id}/ban', [UserController::class, 'ban']);

Route::get('/admin/reviews', [ReviewController::class, 'index']);

Route::post('/admin/reviews/{id}/approve', [ReviewController::class, 'approve']);
Route::post('/admin/reviews/{id}/flag', [ReviewController::class, 'flag']);

Route::get('/admin/account', function(){
    return view('admin.account');
});

Route::post('/admin/account/update', [AccountController::class, 'update']);
Route::post('/admin/account/password', [AccountController::class, 'changePassword']);

Route::get('/admin/products/create', function(){
    return view('admin.products.create', ['categories' => \App\Models\Category::all()]);
});

Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit']);

Route::get('/admin/categories/create', function(){
    return view('admin.categories.create');
});

Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit']);

Route::post('/admin/orders/bulk-update', [OrderController::class, 'bulkUpdate']);

Route::get('/admin/orders/{id}', [OrderController::class, 'show']);




Route::get('/manager/products', [ManagerProductController::class, 'index']);

Route::get('/manager/orders', [ManagerOrderController::class, 'index']);

Route::get('/manager/users', [ManagerUserController::class, 'index']);

Route::get('/manager/users/{id}/reviews', [ManagerUserController::class, 'reviews']);
Route::post('/manager/reviews/{id}/delete-comment', [ManagerUserController::class, 'deleteReviewComment']);

Route::get('/manager/account', function(){
    return view('manager.account');
});

Route::post('/manager/account/update', [ManagerAccountController::class, 'update']);
Route::post('/manager/account/password', [ManagerAccountController::class, 'changePassword']);

Route::get('/manager/roles', [RoleController::class, 'index']);
Route::post('/manager/roles/{id}/update', [RoleController::class, 'updateRole']);

Route::get('/manager/reports', [ReportController::class, 'index']);

Route::get('/manager/reports/{id}', [ReportController::class, 'show']);

Route::get('/manager/dashboard', [DashboardController::class, 'index']);

Route::get('/manager', [DashboardController::class, 'index']);



Route::get('/login', function(){
    return view('auth.login');
});
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', function(){
    return view('auth.register');
});
Route::post('/register', [RegisterController::class, 'register']);


Route::post('/profile/update', [ProfileController::class, 'updateProfile']);     //اطلاعات شخصی و آدرس کاربر
Route::post('/profile/password', [ProfileController::class, 'changePassword']);   //درخواست تغییر رمز عبور

Route::get('/products', [ProductListController::class, 'index']);

Route::get('/products/{id}', [ProductListController::class, 'show']);

Route::get('/profile', function(){
    return view('shop.profile');
});

Route::get('/about', function(){
    return view('shop.about');
});

Route::get('/contact', function(){
    return view('shop.contact');
});

Route::get('/cart', [CartController::class, 'index']);

Route::get('/orders', [OrderHistoryController::class, 'index']);

Route::post('/products/{id}/review', [ReviewSubmitController::class, 'store']);

Route::post('/cart/add/{id}', [CartController::class, 'store']);

Route::post('/checkout', [CartController::class, 'checkout']);
