<?php

namespace App\Http\Controllers\Admins\Noidung\Phongvan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminIntervewController extends Controller
{
    public function index () {
        return view('admin.noidung.phongvan.phongvan');
    }

    public function get_interviewers () {
        $data = DB::table('ungtuyen')
                -> leftJoin('user', 'ungtuyen.id_user', '=', 'user.id')
                -> leftJoin('posts', 'ungtuyen.id_post', '=', 'posts.id')
                -> where('ungtuyen.trangthai', 'Hẹn phỏng vấn')
                ->select('ungtuyen.id_user', 'user.hoten', 'ungtuyen.id', 'ungtuyen.ngayphongvan', 'ungtuyen.trangthai', 'posts.vitrituyen')
                -> get();
        $ungvien = [];
        for ($i = 0; $i < count($data); $i++) $ungvien[$i] = (array)$data[$i];
        $ungvien = array_reverse($ungvien);
        return $ungvien;
    }

    public function update_applicants_status (Request $request, $id) {
        $payload = $request -> payload;
        $ghichu = empty($payload['ghichu']) ? '' : $payload['ghichu'];
        $data = DB::table('ungtuyen') -> where('id', $id)
                    -> update([
                        'trangthai' => $payload['trangthai'],
                        'ngaynhanviec' => $payload['ngaynhanviec'],
                        'ghichu' => $ghichu
                    ]);
        if ($data == 1) return 'success';
        else return 'fail';
    }

    public function nhanviec () {
        return view('admin.noidung.nhanviec.nhanviec');
    }

    public function get_intern () {
        $data = DB::table('ungtuyen')
                -> leftJoin('user', 'ungtuyen.id_user', '=', 'user.id')
                -> leftJoin('posts', 'ungtuyen.id_post', '=', 'posts.id')
                -> where('ungtuyen.trangthai', 'Nhận việc')
                ->select('ungtuyen.id_user', 'user.hoten', 'ungtuyen.id', 'ungtuyen.ngaynhanviec', 'ungtuyen.trangthai', 'posts.vitrituyen')
                -> get();
        $ungvien = [];
        for ($i = 0; $i < count($data); $i++) $ungvien[$i] = (array)$data[$i];
        $ungvien = array_reverse($ungvien);
        return $ungvien;
    }
}
