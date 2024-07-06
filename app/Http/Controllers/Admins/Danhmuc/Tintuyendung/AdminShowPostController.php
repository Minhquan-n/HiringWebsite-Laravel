<?php

namespace App\Http\Controllers\Admins\Danhmuc\Tintuyendung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AdminShowPostController extends Controller
{
    public function index (Request $request) {
        $workplaces = DB::table('chinhanh') -> get();
        $chinhanh = [];
        for($i = 0; $i < count($workplaces); $i++) {
            $chinhanh[$i] = (array)$workplaces[$i];
        }
        $departments = DB::table('phongban') -> get();
        $phongban = [];
        for($i = 0; $i < count($departments); $i++) {
            $phongban[$i] = (array)$departments[$i];
        }
        return view('admin.danhmuc.tintuyendung.tintuyendung', compact('chinhanh', 'phongban'));
    }

    public function tintuyendung () {
        $posts = (DB::table('posts')
                    -> leftJoin('chinhanh', 'posts.id_chinhanh', '=', 'chinhanh.id_chinhanh')
                    -> get());
        $post = [];
        for($i = 0; $i < count($posts); $i++) {
            $post[$i] = (array)$posts[$i];
        }
        $post = array_reverse($post);
        return $post;
    }

    public function antin($id) {
        $post = DB::table('posts') -> where('id', $id) -> update(['status' => 0]);
        return "success";
    }

    public function hientin($id) {
        $post = DB::table('posts') -> where('id', $id) -> update(['status' => 1]);
        return "success";
    }

    public function dangtin (Request $request) {
        $current = date('Y-m-d');
        $payload = $request -> payload;
        $post = DB::table('posts')
                    ->insert([
                        'tieude' => $payload['tieude'],
                        'hannophoso' => $payload['hannophoso'],
                        'vitrituyen' => $payload['vitrituyen'],
                        'soluong' => $payload['soluong'],
                        'dotuoi' => $payload['dotuoi'],
                        'id_chinhanh' => $payload['noilamviec'],
                        'id_phongban' => $payload['phongban'],
                        'gioitinh' => $payload['gioitinh'],
                        'ngaydangtin' => $current,
                        'chitietcv' => $payload['chitietcv'],
                        'yeucaucv' => $payload['yeucaucv'],
                        'quyenloi' => $payload['quyenloi'],
                        'mucluong' => $payload['mucluong']
                    ]);
        return 'success';
    }

    public function chitiettin ($id) {
        $post = DB::table('posts') -> where('id', $id) -> get();
        return compact('post');
    }

    public function capnhattin ($id, Request $request) {
        $payload = $request -> payload;
        $post = DB::table('posts')
                    -> where('id', $id)
                    -> update([
                        'tieude' => $payload['tieude'],
                        'id_chinhanh' => $payload['noilamviec'],
                        'id_phongban' => $payload['phongban'],
                        'vitrituyen' => $payload['vitrituyen'],
                        'soluong' => $payload['soluong'],
                        'dotuoi' => $payload['dotuoi'],
                        'gioitinh' => $payload['gioitinh'],
                        'hannophoso' => $payload['hannophoso'],
                        'chitietcv' => $payload['chitietcv'],
                        'yeucaucv' => $payload['yeucaucv'],
                        'quyenloi' => $payload['quyenloi'],
                        'mucluong' => $payload['mucluong']
                    ]);
        return "success";
    }
}
