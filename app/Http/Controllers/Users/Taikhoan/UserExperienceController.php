<?php

namespace App\Http\Controllers\Users\Taikhoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserExperienceController extends Controller
{
    public function index (Request $request) {
        $usrid = $request -> session() -> get('usr_id');
        $hinhdaidien = ((array)DB::table('usrpersonalinfo') -> where('id_user', $usrid) -> select('hinhdaidien') -> get()[0])['hinhdaidien'];
        $data = DB::table('usrworkexperience') -> where('id_user', $usrid) -> get();
        $exp = (array)$data[0];
        return view('user.taikhoan.hoso.profile_experience_form', compact('hinhdaidien', 'exp'));
    }

    public function experience (Request $request) {
        $usrid = $request -> session() -> get('usr_id');
        $exp = DB::table('usrworkexperience') -> where('id_user', $usrid)
                    -> update([
                        'congviec' => $request -> input('experience_work'),
                        'nambatdau' => $request -> input('experience_start'),
                        'namketthuc' => $request -> input('experience_end'),
                        'tencty' => $request -> input('experience_company'),
                        'vitri' => $request -> input('experience_position'),
                        'nvchinh' => $request -> input('experience_mission'),
                        'luonghientai' => $request -> input('experience_cur_salary'),
                        'luongmongmuon' => $request -> input('experience_wish_salary')
                    ]);
        if ($exp == 1) return redirect() -> back();
    }
}
