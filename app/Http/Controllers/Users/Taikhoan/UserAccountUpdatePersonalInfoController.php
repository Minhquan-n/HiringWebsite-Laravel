<?php

namespace App\Http\Controllers\Users\Taikhoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UserAccountUpdatePersonalInfoController extends Controller
{
    public function index (Request $request) {
        $id = $request -> session() -> get('usr_id');

        // Lay thong tin user
        $user_kh = DB::table('usrpersonalinfo') -> join('user', 'usrpersonalinfo.id_user', '=', 'user.id') -> where('id_user', $id) -> get();
        $user = (array)$user_kh[0];
        // Lay du lieu bang quoctich
        $country = DB::table('quoctich') -> get();
        $quocgia = [];
        for($i = 0; $i < count($country); $i++) $quocgia[$i] = (array)$country[$i];
        // Lay du lieu bang tinhthanh
        $provinces = DB::table('tinhthanh') -> get();
        $tinhthanh = [];
        for($i = 0; $i < count($provinces); $i++) $tinhthanh[$i] = (array)$provinces[$i];
        // Lay du lieu bang dantoc
        $dan = DB::table('dantoc') -> get();
        $dantoc = [];
        for($i = 0; $i < count($dan); $i++) $dantoc[$i] = (array)$dan[$i];

        // Lay bang phuong va quan cua dia chi thuong tru
        $dctr_tinh = $user['dctr_tinh'];
        $add_district = DB::table('quanhuyen') -> where('id_tinhthanh', $dctr_tinh) -> get();
        $dctr_quan_list = [];
        for($i = 0; $i < count($add_district); $i++) $dctr_quan_list[$i] = (array)$add_district[$i];

        $dctr_quan = $user['dctr_quan'];
        $add_ward = DB::table('phuongxa') -> where('idtinhthanh', $dctr_tinh) -> where('idquanhuyen', $dctr_quan) -> get();
        $dctr_phuong_list = [];
        for($i = 0; $i < count($add_ward); $i++) $dctr_phuong_list[$i] = (array)$add_ward[$i];

        // Lay bang phuong va quan cua dia chi lien he
        $dclh_tinh = $user['dctr_tinh'];
        $contact_district = DB::table('quanhuyen') -> where('id_tinhthanh', $dclh_tinh) -> get();
        $dclh_quan_list = [];
        for($i = 0; $i < count($contact_district); $i++) $dclh_quan_list[$i] = (array)$contact_district[$i];

        $dclh_quan = $user['dctr_quan'];
        $contact_ward = DB::table('phuongxa') -> where('idtinhthanh', $dclh_tinh) -> where('idquanhuyen', $dclh_quan) -> get();
        $dclh_phuong_list = [];
        for($i = 0; $i < count($contact_ward); $i++) $dclh_phuong_list[$i] = (array)$contact_ward[$i];

        // Lay hinh dai dien cua user
        $username = $request -> session() -> get('username');
        $path = 'avatar/'.$username;
        $avatar = Storage::files($path);
        $hinhdaidien = $request -> file($avatar);
        if (count($avatar) == 0) $hinhdaidien = 'storage/unknowUser.png';
        else $hinhdaidien = $user['hinhdaidien'];

        return view('user.taikhoan.hoso.profile_personal_form', compact('quocgia', 'tinhthanh', 'user', 'dantoc', 'dctr_quan_list', 'dctr_phuong_list', 'dclh_quan_list', 'dclh_phuong_list', 'hinhdaidien'));
    }

    public function capnhat_ttcn (Request $request) {
        $username = $request -> session() -> get('username');
        $usrid = $request -> session() -> get('usr_id');
        $path = 'avatar/'.$username;
        $avatar = Storage::files($path);
        if (!empty($avatar)) $path = $avatar[0];

        // Luu avatar vao thu muc avatar
        if ($request -> hasFile('avatar_input')) {
            $file = Storage::deleteDirectory('avatar/'.$username);
            $avatar = $request -> file('avatar_input');
            $extn = $avatar -> extension();
            $file_name = $username.'/'.$username.'.'.$extn;
            $path = $avatar -> storeAs('avatar', $file_name, 'public');
        }
        // Lay dia chi thuong tru
        $dctr_sonha = $request -> input('personal_address');
        $tr_tinh = DB::table('tinhthanh') -> where('id_tinhthanh', $request -> input('personal_address_province')) ->select('tentinhthanh') -> get();
        $dctr_tinh = ((array)$tr_tinh[0])['tentinhthanh'];
        $tr_quan = DB::table('quanhuyen') -> where('id_tinhthanh', $request -> input('personal_address_province')) -> where('id_quanhuyen', $request -> input('personal_address_district')) ->select('tenquanhuyen') -> get();
        $dctr_quan = ((array)$tr_quan[0])['tenquanhuyen'];
        $tr_phuong = DB::table('phuongxa') -> where('idtinhthanh', $request -> input('personal_address_province')) -> where('idquanhuyen', $request -> input('personal_address_district')) -> where('id_phuongxa', $request -> input('personal_address_ward')) ->select('tenphuongxa') -> get();
        $dctr_phuong = ((array)$tr_phuong[0])['tenphuongxa'];
        $diachithuongtru = $dctr_sonha.', '.$dctr_phuong.', '.$dctr_quan.', '.$dctr_tinh.'.';

        // Lay dia chi lien he
        $dclh_sonha = $request -> input('personal_contact_address');
        $lh_tinh = DB::table('tinhthanh') -> where('id_tinhthanh', $request -> input('personal_contact_address_province')) ->select('tentinhthanh') -> get();
        $dclh_tinh = ((array)$lh_tinh[0])['tentinhthanh'];
        $lh_quan = DB::table('quanhuyen') -> where('id_tinhthanh', $request -> input('personal_contact_address_province')) -> where('id_quanhuyen', $request -> input('personal_contact_address_district')) ->select('tenquanhuyen') -> get();
        $dclh_quan = ((array)$lh_quan[0])['tenquanhuyen'];
        $lh_phuong = DB::table('phuongxa') -> where('idtinhthanh', $request -> input('personal_contact_address_province')) -> where('idquanhuyen', $request -> input('personal_contact_address_district')) -> where('id_phuongxa', $request -> input('personal_contact_address_ward')) ->select('tenphuongxa') -> get();
        $dclh_phuong = ((array)$lh_phuong[0])['tenphuongxa'];
        $diachilienhe = $dclh_sonha.', '.$dclh_phuong.', '.$dclh_quan.', '.$dclh_tinh.'.';

        // Cap nhat du lieu db
        $usr = DB::table('user') -> where('id', $usrid)
                    -> update(["hoten" => $request -> input('personal_fullname'), "email" => $request -> input('personal_email'), "sdt" => $request -> input('personal_phone'), "gioitinh" => $request -> input('personal_sex')]);
        $personal_info = DB::table('usrpersonalinfo') -> where('id_user', $usrid)
                    -> update([
                        "ngaysinh" => $request -> input('personal_date_of_birth'),
                        "hinhdaidien" => $path,
                        "id_quoctich" => $request -> input('personal_country'),
                        "id_dantoc" => $request -> input('personal_nation'),
                        "diachithuongtru" => $diachithuongtru,
                        "dctr_sonha" => $request -> input('personal_address'),
                        "dctr_tinh" => $request -> input('personal_address_province'),
                        "dctr_quan" => $request -> input('personal_address_district'),
                        "dctr_phuong" => $request -> input('personal_address_ward'),
                        "diachilienhe" => $diachilienhe,
                        "dclh_sonha" => $request -> input('personal_contact_address'),
                        "dclh_tinh" => $request -> input('personal_contact_address_province'),
                        "dclh_quan" => $request -> input('personal_contact_address_district'),
                        "dclh_phuong" => $request -> input('personal_contact_address_ward'),
                        "tennguoithan" => $request -> input('personal_familiar_contact'),
                        "mqh" => $request -> input('personal_familiar_contact_relationship'),
                        "sdt_nguoithan" => $request -> input('personal_familiar_contact_phone')
                    ]);
        return redirect() -> back();
        // dd();
    }

    public function quanhuyen (Request $request) {
        $id = $request -> province;
        $district = DB::table('quanhuyen') -> where('id_tinhthanh', $id) -> get();
        $quanhuyen = [];
        for($i = 0; $i < count($district); $i++) {
            $quanhuyen[$i] = (array)$district[$i];
        }
        return $quanhuyen;
    }

    public function phuongxa (Request $request) {
        $id_tinhthanh = $request -> province;
        $id_quanhuyen = $request -> district;
        $ward = DB::table('phuongxa')
                        -> where('idtinhthanh', $id_tinhthanh)
                        -> where('idquanhuyen', $id_quanhuyen)
                        -> get();
        $phuongxa = [];
        for($i = 0; $i < count($ward); $i++) {
            $phuongxa[$i] = (array)$ward[$i];
        }
        return $phuongxa;
    }
}
