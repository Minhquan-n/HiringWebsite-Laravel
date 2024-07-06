<?php

namespace App\Http\Controllers\Admins\Danhmuc\Phongban;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDepartmentController extends Controller
{
    public function index (Request $request) {
        $departments = DB::table('phongban') -> get();
        $phongban = [];
        for($i = 0; $i < count($departments); $i++) {
            $phongban[$i] = (array)$departments[$i];
        }
        return view('admin.danhmuc.phongban.phongban', compact('phongban'));
    }

    public function themphongban (Request $request) {
        $name = $request -> name;
        $phongban = DB::table('phongban') -> insert(['tenphongban' => $name]);
        return "success";
    }

    public function capnhatphongban ($id, Request $request) {
        $name = $request -> name;
        $phongban = DB::table('phongban') -> where('id_phongban', $id) -> update(['tenphongban' => $name]);
        return "success";
    }
}
