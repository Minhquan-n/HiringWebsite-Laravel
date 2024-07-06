<?php

namespace App\Http\Controllers\Admins\Danhmuc\Chinhanh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminWorkplaceController extends Controller
{
    public function index (Request $request) {
        $workplaces = DB::table('chinhanh') -> get();
        $chinhanh = [];
        for($i = 0; $i < count($workplaces); $i++) {
            $chinhanh[$i] = (array)$workplaces[$i];
        }
        return view('admin.danhmuc.chinhanh.chinhanh', compact('chinhanh'));
    }

    public function themchinhanh (Request $request) {
        $name = $request -> name;
        $chinhanh = DB::table('chinhanh') -> insert(['tenchinhanh' => $name]);
        return "success";
    }

    public function capnhatchinhanh (Request $request, $id) {
        $name = $request -> name;
        $chinhanh = DB::table('chinhanh') -> where('id_chinhanh', $id) -> update(['tenchinhanh' => $name]);
        return "success";
    }
}
