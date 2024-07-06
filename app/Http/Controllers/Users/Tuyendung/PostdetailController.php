<?php

namespace App\Http\Controllers\Users\Tuyendung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostdetailController extends Controller
{
    public function index($id) {
        $title = '';
        $tin = [];
        $today = date('Y-m-d');
        $posts = DB::table('posts')
                    -> leftJoin('chinhanh', 'posts.id_chinhanh', '=', 'chinhanh.id_chinhanh')
                    ->leftJoin('phongban', 'posts.id_phongban', '=', 'phongban.id_phongban')
                    ->where('status', 1)
                    ->where('hannophoso', '>=', $today)
                    -> get();
        $post = [];
        for($i = 0; $i < count($posts); $i++) {
            $post[$i] = (array)$posts[$i];
            if ($post[$i]['id'] == $id) {
                $title = $post[$i]['vitrituyen'];
                $tin = $post[$i];
                $chitiet = preg_split("/[\n]/", $post[$i]['chitietcv']);
                $yeucau = preg_split("/[\n]/", $post[$i]['yeucaucv']);
                $quyenloi = preg_split("/[\n]/", $post[$i]['quyenloi']);
                $tin['chitietcv'] = $chitiet;
                $tin['yeucaucv'] = $yeucau;
                $tin['quyenloi'] = $quyenloi;
            }
        }
        $post = array_reverse($post);
        return view('user.tuyendung.chitiettin', compact('title', 'tin', 'post'));
    }
}
