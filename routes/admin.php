<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\View\AdminLayoutController;
use App\Http\Controllers\Admins\Danhmuc\Tintuyendung\AdminShowPostController;
use App\Http\Controllers\Admins\Danhmuc\Phongban\AdminDepartmentController;
use App\Http\Controllers\Admins\Danhmuc\Chinhanh\AdminWorkplaceController;
use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Admins\Account\AdminAccountController;
use App\Http\Controllers\Admins\Noidung\Phongvan\AdminIntervewController;
use App\Http\Controllers\Admins\Noidung\Ungvien\AdminApplicantController;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\CheckAdminLogout;

Route::get('/admin-layout', [
    AdminLayoutController::class,
    'index'
]) -> middleware(CheckLogin::class);

Route::get('/admin',[
    AdminLayoutController::class,
    'dangnhap'
]) -> middleware(CheckAdminLogout::class);

Route::post('/admin',[
    AdminLayoutController::class,
    'login'
]) -> middleware(CheckAdminLogout::class);

Route::get('/logout', [
    AdminLayoutController::class,
    'logout'
]) -> middleware(CheckLogin::class);

// Cac route xu ly trang chu
Route::get('/trangchu', [
    AdminController::class,
    'index'
]) -> middleware(CheckLogin::class);

// Cac trang thuoc nhom Danh muc
// Cac route xu ly trang Tin tuyen dung
Route::get('/danhmuc/tintuyendung', [
    AdminShowPostController::class,
    'index'
]) -> middleware(CheckLogin::class);

Route::get('/danhmuc/laytintuyendung', [
    AdminShowPostController::class,
    'tintuyendung'
]) -> middleware(CheckLogin::class);

Route::post('/danhmuc/tintuyendung', [
    AdminShowPostController::class,
    'dangtin'
]) -> middleware(CheckLogin::class);

Route::get('/danhmuc/tintuyendung/{id}', [
    AdminShowPostController::class,
    'chitiettin'
]) -> middleware(CheckLogin::class);

Route::post('/danhmuc/tintuyendung/{id}', [
    AdminShowPostController::class,
    'capnhattin'
]) -> middleware(CheckLogin::class);

Route::put('/danhmuc/tintuyendung/{id}', [
    AdminShowPostController::class,
    'antin'
]) -> middleware(CheckLogin::class);

Route::patch('/danhmuc/tintuyendung/{id}', [
    AdminShowPostController::class,
    'hientin'
]) -> middleware(CheckLogin::class);

// Cac route xu ly trang Phong ban
Route::get('/danhmuc/phongban', [
    AdminDepartmentController::class,
    'index'
]) -> middleware(CheckLogin::class);

Route::post('/danhmuc/phongban', [
    AdminDepartmentController::class,
    'themphongban'
]) -> middleware(CheckLogin::class);

Route::post('/danhmuc/phongban/{id}', [
    AdminDepartmentController::class,
    'capnhatphongban'
]) -> middleware(CheckLogin::class);

// Cac route xu ly trang Chi nhanh

Route::get('/danhmuc/chinhanh', [
    AdminWorkplaceController::class,
    'index'
]) -> middleware(CheckLogin::class);

Route::post('/danhmuc/chinhanh', [
    AdminWorkplaceController::class,
    'themchinhanh'
]) -> middleware(CheckLogin::class);

Route::post('/danhmuc/chinhanh/{id}', [
    AdminWorkplaceController::class,
    'capnhatchinhanh'
]) -> middleware(CheckLogin::class);

// Cac trang thuoc nhom Tai khoan
// Cac route xu ly trang tai khoan ca nhan
Route::get('/taikhoancanhan', [
    AdminAccountController::class,
    'index'
]) -> middleware(CheckLogin::class);

// Cac trang thuoc nhom Noi dung
// Cac route xu ly trang ung vien
Route::get('/noidung/ungvien', [
    AdminApplicantController::class,
    'index'
]) -> middleware(CheckLogin::class);

Route::get('/noidung/applicants', [
    AdminApplicantController::class,
    'get_applicants'
]) -> middleware(CheckLogin::class);

Route::get('/noidung/applicants/{id}', [
    AdminApplicantController::class,
    'get_applicants_status'
]) -> middleware(CheckLogin::class);

Route::post('/noidung/applicants/{id}', [
    AdminApplicantController::class,
    'update_applicants_status'
]) -> middleware(CheckLogin::class);

Route::get('/noidung/applicant_cv/{id}', [
    AdminApplicantController::class,
    'show_cv_applicant'
]) -> middleware(CheckLogin::class);

// Cac route xu ly trang phong van
Route::get('/noidung/phongvan', [
    AdminIntervewController::class,
    'index'
]) -> middleware(CheckLogin::class);

Route::get('/noidung/interview', [
    AdminIntervewController::class,
    'get_interviewers'
]) -> middleware(CheckLogin::class);

Route::post('/noidung/interview/{id}', [
    AdminIntervewController::class,
    'update_applicants_status'
]) -> middleware(CheckLogin::class);

// Cac route xu ly trang nhan viec
Route::get('/noidung/nhanviec', [
    AdminIntervewController::class,
    'nhanviec'
]) -> middleware(CheckLogin::class);

Route::get('/noidung/intern', [
    AdminIntervewController::class,
    'get_intern'
]) -> middleware(CheckLogin::class);
