<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ToKhai;
use App\Http\Requests\UserRequest;
use App\Models\DangKyTiemChung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $datas = ToKhai::getInfoByUserID(Auth::id());
        return view('users.to-khai.index', compact('datas'));
    }

    public function khaiBao()
    {
        return view('users.to-khai.khai-bao-y-te');
    }

    public function storeKhaiBao(Request $request)
    {
        $tokhai['user_id'] = Auth::id();
        $tokhai['transportations'] = $request->transportations;
        $tokhai['transportations_identify'] = $request->transportations_identify;
        $tokhai['departure_place'] = $request->departure_place;
        $tokhai['departure_date'] = $request->departure_date;
        $tokhai['arrival_place'] = $request->arrival_place;
        $tokhai['pass_country'] = $request->pass_country;
        $tokhai['pass_country_note'] = $request->pass_country_note;
        $tokhai['has_signal'] = $request->has_signal;
        $tokhai['signal_note'] = $request->signal_note;
        $tokhai['has_patient'] = $request->has_patient;
        $tokhai['has_from_sick_country'] = $request->has_from_sick_country;
        $tokhai['has_sick'] = $request->has_sick;

        ToKhai::create($tokhai);
        return redirect()->route('index.khai-bao')
            ->with('success', __('Khai báo thành công!'));
    }

    public function editKhaiBao($id)
    {
        $data = ToKhai::getInfoByID($id);

        return view('users.to-khai.edit-to-khai', compact('data'));
    }

    public function updateKhaiBao(Request $request, $id)
    {
        $data = ToKhai::getInfoByID($id);
        $data['user_id'] = Auth::id();
        $data['transportations'] = $request->transportations;
        $data['transportations_identify'] = $request->transportations_identify;
        $data['departure_place'] = $request->departure_place;
        $data['departure_date'] = $request->departure_date;
        $data['arrival_place'] = $request->arrival_place;
        $data['pass_country'] = $request->pass_country;

        if ($request->pass_country == 0) {
            $data['pass_country_note'] = "";
        } else {
            $data['pass_country_note'] = $request->pass_country_note;
        }

        $data['has_signal'] = $request->has_signal;

        if ($request->has_signal == 0) {
            $data['signal_note'] = "";
        } else {
            $data['signal_note'] = $request->signal_note;
        }

        $data['has_patient'] = $request->has_patient;
        $data['has_from_sick_country'] = $request->has_from_sick_country;
        $data['has_sick'] = $request->has_sick;

        $data->save();

        if ($data->save()) {
            return redirect()->route('edit.to-khai', $id)
            ->with('success', __('Chỉnh sửa khai báo thành công!'));
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function indexTiemChung()
    {
        $datas = DangKyTiemChung::getInfoByUserID(Auth::id());
        $user = User::getUserByID(Auth::id());

        return view('users.tiem-chung.index', compact('datas', 'user'));
    }

    public function createTiemChung()
    {
        return view('users.tiem-chung.create');
    }

    public function storeTiemChung(Request $request)
    {
        $dang_ky['user_id'] = Auth::id();
        $dang_ky['ordinal_of_injection'] = $request->ordinalOfInjection;
        $dang_ky['date_of_injection_register'] = $request->dateOfInjectionRegister;
        $dang_ky['part_of_injection_day'] = $request->partOfInjectionDay;
        $dang_ky['priority_group'] = $request->priorityGroup;
        $dang_ky['note'] = $request->note;

        DangKyTiemChung::create($dang_ky);

        return redirect()->route('index.tiem-chung')
            ->with('success', __('Đăng ký tiêm chủng thành công!'));
    }

    public function editTiemChung($id)
    {
        $data = DangKyTiemChung::getInforByID($id);

        return view('users.tiem-chung.edit', compact('data'));
    }

    public function updateTiemChung(Request $request, $id)
    {
        $dang_ky = DangKyTiemChung::getInforByID($id);

        $dang_ky['ordinal_of_injection'] = $request->ordinalOfInjection;
        $dang_ky['date_of_injection_register'] = $request->dateOfInjectionRegister;
        $dang_ky['part_of_injection_day'] = $request->partOfInjectionDay;
        $dang_ky['priority_group'] = $request->priorityGroup;
        $dang_ky['note'] = $request->note;

        $dang_ky->save();

        if ($dang_ky->save()) {
            return redirect()->route('edit.tiem-chung', $id)
            ->with('success', __('Chỉnh sửa khai báo thành công!'));
        } else {
            return redirect()->back()->withInput();
        }
    }
}
