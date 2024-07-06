<?php

namespace App\Http\Controllers\Admins\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminLayoutController extends Controller
{
    public function index (Request $request) {
        $token = $request -> session() -> token();
        $token = csrf_token();
        $username = $request -> session() -> get('username');
        $title = $request -> session() -> get('fullname');
        return compact('token', 'title', 'username');
    }

    public function dangnhap () {
        return view('layouts.admin_login');
    }

    public function login (Request $request) {
        $email = $request -> input('signin_email');
        $password = $request -> input('signin_password');
        $account = DB::table('admin') -> where('email', $email) -> exists();
        if ($account) {
            $user = (array)(DB::table('admin') -> where('email', $email) -> get())[0];
            // $check_matkhau = Hash::check($password, ($user['matkhau']));
            if (/*$check_matkhau*/$password == $user['matkhau']) {
                $request -> session() -> put('loggedin', 'true');
                $request -> session() -> put('email', $email);
                $request -> session() -> put('username', $user['username']);
                $request -> session() -> put('fullname', $user['hoten']);
                $request -> session() -> put('adm_id', $user['id']);
                return redirect('/trangchu');
            }
        }
        return redirect() -> back() -> with("status", "fail");
    }

    public function logout (Request $request) {
        $request -> session() -> flush();
        if (!($request -> session() -> has('email'))) return redirect('/admin');
    }
}
