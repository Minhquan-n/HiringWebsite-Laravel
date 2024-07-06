<?php

namespace App\Http\Controllers\Users\Taikhoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAccountAppliedController extends Controller
{
    public function index (Request $request) {
        $usrid = $request -> session() -> get('usr_id');
        $hinhdaidien = ((array)DB::table('usrpersonalinfo') -> where('id_user', $usrid) -> select('hinhdaidien') -> get()[0])['hinhdaidien'];
        return view('user.taikhoan.ungtuyen.ungtuyen', compact('hinhdaidien'));
    }

    public function get_applied (Request $request) {
        $usrid = $request -> session() -> get('usr_id');
        $data = DB::table('ungtuyen') -> leftJoin('posts', 'ungtuyen.id_post', '=', 'posts.id')
                                    -> where('id_user', $usrid) -> get();
        $applied = [];
        for($i = 0; $i < count($data); $i++) $applied[$i] = (array)$data[$i];
        $applied = array_reverse($applied);
        return $applied;
    }
}
