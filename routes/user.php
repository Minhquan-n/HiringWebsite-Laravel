<?php

use App\Http\Controllers\Users\Taikhoan\UserAccountAppliedController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\Taikhoan\UserAccountController;
use App\Http\Controllers\Users\Taikhoan\UserAccountProfile;
use App\Http\Controllers\Users\Taikhoan\UserAccountUpdatePersonalInfoController;
use App\Http\Controllers\Users\Taikhoan\UserEducationFormController;
use App\Http\Controllers\Users\Taikhoan\UserExperienceController;
use App\Http\Controllers\Users\Taikhoan\UserParentController;
use App\Http\Controllers\Users\Taikhoan\UserSkillController;
use App\Http\Controllers\Users\Tuyendung\PostdetailController;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\CheckUserLogin;

// Route xu ly trang tai khoan ca nhan khach
// Lay thong tin set header cho trang
Route::get('/user_layout', [
    UserAccountController::class,
    'index'
]) -> middleware(CheckUserLogin::class);

// Cac route xu ly trang tin moi
Route::get('/taikhoan/tinmoi', [
    UserAccountController::class,
    'tinmoi'
]) -> middleware(CheckUserLogin::class);

Route::get('/taikhoan/newpost', [
    UserAccountController::class,
    'newpost'
]) -> middleware(CheckUserLogin::class);

Route::post('/taikhoan/newpost', [
    UserAccountController::class,
    'get_status'
]) -> middleware(CheckUserLogin::class);

Route::get('/taikhoan/newpost/{id}', [
    PostdetailController::class,
    'index'
]) -> middleware(CheckUserLogin::class);

Route::post('/taikhoan/newpost/{id}', [
    UserAccountController::class,
    'apply'
]) -> middleware(CheckUserLogin::class);

// Cac route xu ly trang ho so
Route::get('/taikhoan/hoso', [
    UserAccountProfile::class,
    'index'
]) -> middleware(CheckUserLogin::class);

// Cac route xu ly cac trang cap nhat
Route::get('taikhoan/hoso/capnhat', [
    UserAccountProfile::class,
    'update'
]) -> middleware(CheckUserLogin::class);

// Cac route xu ly cap nhat thong tin ly lich
Route::get('taikhoan/hoso/lylich', [
    UserAccountUpdatePersonalInfoController::class,
    'index'
]) -> middleware(CheckUserLogin::class);

Route::post('taikhoan/hoso/lylich', [
    UserAccountUpdatePersonalInfoController::class,
    'capnhat_ttcn'
]) -> middleware(CheckUserLogin::class);

Route::get('/taikhoan/hoso/capnhat/quan', [
    UserAccountUpdatePersonalInfoController::class,
    'quanhuyen'
]) -> middleware(CheckUserLogin::class);

Route::get('/taikhoan/hoso/capnhat/phuong', [
    UserAccountUpdatePersonalInfoController::class,
    'phuongxa'
]) -> middleware(CheckUserLogin::class);

// Cac route xu ly cap nhat thong tin hoc van
Route::get('/taikhoan/hoso/hocvan', [
    UserEducationFormController::class,
    'index'
]) -> middleware(CheckUserLogin::class);

Route::post('/taikhoan/hoso/hocvan', [
    UserEducationFormController::class,
    'education'
])  -> middleware(CheckUserLogin::class);

// Cac route xu ly trang cap nhat thong tin kinh nghiem
Route::get('/taikhoan/hoso/kinhnghiem', [
    UserExperienceController::class,
    'index'
])  -> middleware(CheckUserLogin::class);

Route::post('/taikhoan/hoso/kinhnghiem', [
    UserExperienceController::class,
    'experience'
])  -> middleware(CheckUserLogin::class);

// Cac route xu ly trang cap nhat thong tin ky nang
Route::get('/taikhoan/hoso/kynang', [
    UserSkillController::class,
    'index'
])  -> middleware(CheckUserLogin::class);

Route::post('/taikhoan/hoso/kynang', [
    UserSkillController::class,
    'skill'
])  -> middleware(CheckUserLogin::class);

// Cac route xu ly trang cap nhat thong tin nguoi than
Route::get('/taikhoan/hoso/nguoithan', [
    UserParentController::class,
    'index'
])  -> middleware(CheckUserLogin::class);

Route::post('/taikhoan/hoso/nguoithan', [
    UserParentController::class,
    'parent'
])  -> middleware(CheckUserLogin::class);

// Cac route xu ly trang ung tuyen
Route::get('/taikhoan/ungtuyen', [
    UserAccountAppliedController::class,
    'index'
]) -> middleware(CheckUserLogin::class);

Route::get('/taikhoan/applied', [
    UserAccountAppliedController::class,
    'get_applied'
]) -> middleware(CheckUserLogin::class);
