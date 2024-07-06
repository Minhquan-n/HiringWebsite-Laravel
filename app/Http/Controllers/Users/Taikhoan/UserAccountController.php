<?php

namespace App\Http\Controllers\Users\Taikhoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class UserAccountController extends Controller
{
    public function index (Request $request) {
        $token = $request -> session() -> token();
        $token = csrf_token();
        $username = $request -> session() -> get('username');
        $title = $request -> session() -> get('fullname');
        $path = 'avatar/'.$username;
        $avatar = Storage::files($path);
        $hinhdaidien = $request -> file($avatar);
        if (count($avatar) == 0) $hinhdaidien = 'storage/unknowUser.png';
        else $hinhdaidien = $avatar[0];
        return compact('token', 'title', 'username', 'hinhdaidien');
    }

    public function tinmoi (Request $request) {
        $username = $request -> session() -> get('username');
        $path = 'avatar/'.$username;
        $avatar = Storage::files($path);
        $hinhdaidien = $request -> file($avatar);
        if (count($avatar) == 0) $hinhdaidien = 'storage/unknowUser.png';
        else $hinhdaidien = $avatar[0];
        return view('user.taikhoan.tinmoi.tinmoi', compact('hinhdaidien'));
    }

    public function newpost (Request $request) {
        $today = date('Y-m-d');
        $posts = DB::table('posts')
                    -> leftJoin('chinhanh', 'posts.id_chinhanh', '=', 'chinhanh.id_chinhanh')
                    ->leftJoin('phongban', 'posts.id_phongban', '=', 'phongban.id_phongban')
                    ->where('status', 1)
                    ->where('hannophoso', '>=', $today)
                    -> get();
        $post = [];
        for($i = 0; $i < count($posts); $i++) $post[$i] = (array)$posts[$i];
        $post = array_reverse($post);
        $usrid = $request -> session() -> get('usr_id');
        $ungtuyen = DB::table('ungtuyen') -> where('id_user', $usrid) -> get();
        $applied = [];
        for($i = 0; $i < count($ungtuyen); $i++) $applied[$i] = (array)$ungtuyen[$i];
        return compact('post', 'applied');
    }

    public function get_status (Request $request) {
        $usrid = $request -> session() -> get('usr_id');
        $ttcn = (array)DB::table('usrpersonalinfo') -> where('id_user', $usrid) -> get()[0];
        $ttcn_status = count(array_filter($ttcn, function ($val) { return $val == null; }));
        $tthv = (array)DB::table('usreducation') -> where('id_user', $usrid) -> get()[0];
        $tthv_status = count(array_filter($tthv, function ($val) { return $val == null; }));
        $ttkn = (array)DB::table('usrskill') -> where('id_user', $usrid) -> get()[0];
        $ttkn_status = ($ttkn['tinhoc'] || $ttkn['ngoaingu']) == null ? 1 : 0;

        $status_all = ['ttcn' => $ttcn_status, 'tthv' => $tthv_status, 'ttkn' => $ttkn_status];
        $status = count(array_filter($status_all, function ($val) {return $val != 0;}));
        return $status;
    }

    public function apply (Request $request, $id) {
        $usrid = $request -> session() -> get('usr_id');
        $current = date('Y-m-d');
        $intern = DB::table('ungtuyen')
                    -> insert([
                        'id_user' => $usrid,
                        'id_post' => $id,
                        'ngayungtuyen' => $current,
                        'ngayphongvan' => $current
                    ]);
        if ($intern == 1) return 'success';
    }
}
