<?php

namespace App\Http\Controllers\Admins\Noidung\Ungvien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminApplicantController extends Controller
{
    public function index () {
         return view('admin.noidung.ungvien.ungvien');
    }

    public function get_applicants () {
        $data = DB::table('ungtuyen')
                -> leftJoin('user', 'ungtuyen.id_user', '=', 'user.id')
                -> leftJoin('posts', 'ungtuyen.id_post', '=', 'posts.id')
                ->select('ungtuyen.id_user', 'user.hoten', 'ungtuyen.id', 'ungtuyen.ngayungtuyen', 'ungtuyen.trangthai', 'posts.vitrituyen')
                -> get();
        $ungvien = [];
        for ($i = 0; $i < count($data); $i++) $ungvien[$i] = (array)$data[$i];
        $ungvien = array_reverse($ungvien);
        return $ungvien;
    }

    public function get_applicants_status (Request $request, $id) {
        $data = (array)DB::table('ungtuyen') -> where('id', $id) -> get()[0];
        return $data;
    }

    public function update_applicants_status (Request $request, $id) {
        $payload = $request -> payload;
        $ghichu = empty($payload['ghichu']) ? '' : $payload['ghichu'];
        $data = DB::table('ungtuyen') -> where('id', $id)
                    -> update([
                        'trangthai' => $payload['trangthai'],
                        'ngayphongvan' => $payload['ngayphongvan'],
                        'ghichu' => $ghichu
                    ]);
        if ($data == 1) return 'success';
        else return 'fail';
    }

    public function show_cv_applicant (Request $request, $id) {
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
                         -> select('hinhdaidien', 'ngaysinh','diachithuongtru', 'diachilienhe', 'tennguoithan', 'mqh', 'sdt_nguoithan', 'email', 'sdt', 'hoten', 'gioitinh', 'tenquocgia', 'tendantoc')
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
         return view('admin.noidung.ungvien.ungvien_cv', compact('hinhdaidien', 'user', 'status', 'ttexp', 'ttkn', 'ttnt', 'edu', 'skill', 'exp', 'parent'));
    }
}
