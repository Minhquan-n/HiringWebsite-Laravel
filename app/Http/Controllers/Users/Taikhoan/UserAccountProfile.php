<?php

namespace App\Http\Controllers\Users\Taikhoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserAccountProfile extends Controller
{
    public function index (Request $request) {
        $username = $request -> session() -> get('username');
        $id = $request -> session() -> get('usr_id');

        // Lay trang thai thong tin user
        $ttcn = (array)DB::table('usrpersonalinfo') -> where('id_user', $id) -> get()[0];
        $ttcn_status = count(array_filter($ttcn, function ($val) { return $val == null; }));
        $tthv = (array)DB::table('usreducation') -> where('id_user', $id) -> get()[0];
        $tthv_status = count(array_filter($tthv, function ($val) { return $val == null; }));
        $ttkn_status = (array)DB::table('usrskill') -> where('id_user', $id) -> get()[0];
        $ttkn = count(array_filter($ttkn_status, function ($val) { return $val == null; }));
        $status_arr = ['ttcn' => $ttcn_status, 'tthv' => $tthv_status, 'ttkn' => $ttkn];
        $status = count(array_filter($status_arr, function ($val) { return $val != 0; }));
        // Lay trang thai cac thong tin bo sung khac
        $ttexp_status = (array)DB::table('usrworkexperience') -> where('id_user', $id) -> get()[0];
        $ttexp = count(array_filter($ttexp_status, function ($val) { return $val == null; }));
        $ttnt_status = (array)DB::table('usrnguoithan') -> where('id_user', $id) -> get()[0];
        $ttnt = count(array_filter($ttnt_status, function ($val) { return $val == null; }));

        // Lay thong tin ca nhan user
        $user_kh = DB::table('usrpersonalinfo')
                        -> join('user', 'usrpersonalinfo.id_user', '=', 'user.id')
                        -> join('quoctich', 'usrpersonalinfo.id_quoctich', '=', 'quoctich.id_quoctich')
                        -> join('dantoc', 'usrpersonalinfo.id_dantoc', '=', 'dantoc.id_dantoc')
                        -> where('id_user', $id)
                        -> get();
        $user = (array)$user_kh[0];
        // Lay thong tin hoc van
        $user_edu = DB::table('usreducation') -> where('id_user', $id) -> get();
        $edu = (array)$user_edu[0];
        // Lay thong tin ky nang
        $user_skill = DB::table('usrskill') -> where('id_user', $id) -> get();
        $skill = (array)$user_skill[0];
        // Lay thong tin kinh nghiem
        $user_exp = DB::table('usrworkexperience') -> where('id_user', $id) -> get();
        $exp = (array)$user_exp[0];
        // Lay thong tin kinh nghiem
        $user_nt = DB::table('usrnguoithan') -> where('id_user', $id) -> get();
        $parent = [];
        for($i = 0; $i < count($user_nt); $i++) $parent[$i] = (array)$user_nt[$i];

        // Lay hinh dai dien
        $hinhdaidien = $user['hinhdaidien'];
        return view('user.taikhoan.hoso.profile', compact('hinhdaidien', 'user', 'status', 'ttexp', 'ttkn', 'ttnt', 'edu', 'skill', 'exp', 'parent'));
    }

    public function update (Request $request) {
        $username = $request -> session() -> get('username');
        $usrid = $request -> session() -> get('usr_id');

        // Lay trang thai cac truong
        $ttcn = (array)DB::table('usrpersonalinfo') -> where('id_user', $usrid) -> get()[0];
        $ttcn_status = count(array_filter($ttcn, function ($val) { return $val == null; }));
        $tthv = (array)DB::table('usreducation') -> where('id_user', $usrid) -> get()[0];
        $tthv_status = count(array_filter($tthv, function ($val) { return $val == null; }));
        $ttkn = (array)DB::table('usrskill') -> where('id_user', $usrid) -> get()[0];
        $ttkn_status = ($ttkn['tinhoc'] || $ttkn['ngoaingu']) == null ? 1 : 0;
        $ttexp = (array)DB::table('usrworkexperience') -> where('id_user', $usrid) -> get()[0];
        $ttexp_status = count(array_filter($ttexp, function ($val) { return $val == null; }));
        $ttnt = (array)DB::table('usrnguoithan') -> where('id_user', $usrid) -> get()[0];
        $ttnt_status = count(array_filter($ttnt, function ($val) { return $val == null; }));

        $status = ['ttcn' => $ttcn_status, 'tthv' => $tthv_status, 'ttkn' => $ttkn_status, 'ttexp' => $ttexp_status, 'ttnt' => $ttnt_status];

        $hinhdaidien = $ttcn['hinhdaidien'];

        return view('user.taikhoan.hoso.profile_update', compact('hinhdaidien', 'status'));
    }
}
