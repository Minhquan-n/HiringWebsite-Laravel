<?php

namespace App\Http\Controllers\Users\Layout;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

class LayoutController extends Controller
{
    public function index(Request $request) {
        $token = $request -> session() -> token();
        $token = csrf_token();
        return compact('token');
    }

    public function dangky (Request $request) {
        try {
            $email = $request -> payload['email'];
            $username = substr($email, 0, (strpos($email, "@")));
            $payload = [
                'email' => $request -> payload['email'],
                'password' => Hash::make($request -> payload['password']),
                'phone' => $request -> payload['phone'],
                'fullname' => $request -> payload['fullname'],
                'sex' => $request -> payload['sex'],
                'username' => $username
            ];
            $current = date('Y-m-d');
            $user = DB::table('user') -> insert([
                'email' => $payload['email'],
                'matkhau' => $payload['password'],
                'sdt' => $payload['phone'],
                'hoten' => $payload['fullname'],
                'gioitinh' => $payload['sex'],
                'ngaytao' => $current,
                'username' => $username
            ]);
            if($user == 1) {
                $temp = DB::table('user') -> where('email', $email) -> get();
                $userid = (array)$temp[0];
                $usrinfo = DB::table('usrpersonalinfo') -> insert(['id_user' => $userid['id'], 'ngaysinh' => $current]);
                $usreducation = DB::table('usreducation') -> insert(['id_user' => $userid['id']]);
                $usrexperience = DB::table('usrworkexperience') -> insert(['id_user' => $userid['id']]);
                $usrskill = DB::table('usrskill') -> insert(['id_user' => $userid['id']]);
                $usrnguoithan = DB::table('usrnguoithan') -> insert(['id_user' => $userid['id']]);
                return "success";
            } else return "fail";
        } catch (Exception $e) { return "fail"; }
    }

    public function dangnhap (Request $request) {
        try {
            $email = $request -> input('signin_email');
            $password = $request -> input('signin_password');
            $account = DB::table('user') -> where('email', $email) -> exists();
            if ($account) {
                $user = (array)(DB::table('user') -> where('email', $email) -> get())[0];
                $check_matkhau = Hash::check($password, ($user['matkhau']));
                if ($check_matkhau) {
                    $request -> session() -> put('loggedin', 'true');
                    $request -> session() -> put('email', $email);
                    $request -> session() -> put('username', $user['username']);
                    $request -> session() -> put('fullname', $user['hoten']);
                    $request -> session() -> put('usr_id', $user['id']);
                    return redirect('/taikhoan/hoso');
                }
            }
            return redirect() -> back() -> with("status", "fail");
        } catch (Exception $e) { return redirect() -> back() -> with("status", "fail"); }
    }

    public function dangxuat (Request $request) {
        $request -> session() -> flush();
        if (!($request -> session() -> has('email'))) return redirect('/');
    }
}
