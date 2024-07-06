<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\Layout\LayoutController;
use App\Http\Controllers\Users\Trangchu\HomeController;
use App\Http\Controllers\Users\Trangtinh\OtherPageController;
use App\Http\Controllers\Users\Tuyendung\PostController;
use App\Http\Controllers\Users\Tuyendung\PostdetailController;
use App\Http\Middleware\CheckLogout;
use App\Http\Middleware\CheckUserLogin;

Route::get('/user-layout', [
    LayoutController::class,
    'index'
]) -> middleware(CheckLogout::class);

// Cac Route xu ly trang chu
Route::get('/', [
    HomeController::class,
    'trangchu'
]) -> middleware(CheckLogout::class);

Route::post('/dangky', [
    LayoutController::class,
    'dangky'
]) -> middleware(CheckLogout::class);

Route::post('/dangnhap', [
    LayoutController::class,
    'dangnhap'
]) -> middleware(CheckLogout::class);

Route::get('/dangxuat', [
    LayoutController::class,
    'dangxuat'
]) -> middleware(CheckUserLogin::class);

// Cac Route xu ly trang tin tuyen dung
Route::get('/tuyendung', [
    PostController::class,
    'index'
]) -> middleware(CheckLogout::class);

Route::get('/tuyendung-post', [
    PostController::class,
    'tuyendung'
]) -> middleware(CheckLogout::class);

Route::get('/tuyendung/{id}', [
    PostdetailController::class,
    'index'
]) -> middleware(CheckLogout::class);

Route::get('/gioithieu', [
    OtherPageController::class,
    'gioithieu'
]) -> middleware(CheckLogout::class);

Route::get('/lienhe', [
    OtherPageController::class,
    'lienhe'
]) -> middleware(CheckLogout::class);

