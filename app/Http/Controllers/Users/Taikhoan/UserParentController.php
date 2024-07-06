<?php

namespace App\Http\Controllers\Users\Taikhoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserParentController extends Controller
{
    public function index (Request $request) {
        $usrid = $request -> session() -> get('usr_id');
        $hinhdaidien = ((array)DB::table('usrpersonalinfo') -> where('id_user', $usrid) -> select('hinhdaidien') -> get()[0])['hinhdaidien'];
        $data = DB::table('usrnguoithan') -> where('id_user', $usrid) -> get();
        $parent = [];
        for($i = 0; $i < count($data); $i++) $parent[$i] = (array)$data[$i];
        return view('user.taikhoan.hoso.profile_parent_form', compact('hinhdaidien', 'parent'));
    }

    public function parent (Request $request) {
        $usrid = $request -> session() -> get('usr_id');
        $parent = DB::table('usrnguoithan') -> where('id_user', $usrid)
                    -> update([
                        'hoten_nguoithan' => $request -> input('parent_name'),
                        'mqh_nguoithan' => $request -> input('parent_relationship'),
                        'noilamviec_nguoithan' => $request -> input('parent_position'),
                        'sdt_nguoithan' => $request -> input('parent_phone')
                    ]);
        if ($parent == 1) return redirect() -> back();
    }
}
