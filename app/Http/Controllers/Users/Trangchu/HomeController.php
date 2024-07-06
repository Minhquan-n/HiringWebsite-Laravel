<?php

namespace App\Http\Controllers\Users\Trangchu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function trangchu() {
        $title = 'Trang chủ';
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
        }
        $agencies = DB::table('chinhanh') -> get();
        $agency = [];
        for($i = 0; $i < count($agencies); $i++) {
            $agency[$i] = (array)$agencies[$i];
        }
        $departments = DB::table('phongban') -> get();
        $deparrtment = [];
        for($i = 0; $i < count($departments); $i++) {
            $department[$i] = (array)$departments[$i];
        }
        $post = array_reverse($post);
        return view('user.trangchu.trangchu', compact('title', 'post', 'agency', 'department'));
    }
}
