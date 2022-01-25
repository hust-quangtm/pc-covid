<?php

namespace App\Http\Controllers;

use App\Models\LichSuTiemChung;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function indexUser()
    {
        $users = User::orderBy('id', 'ASC')->get();
        $vaccined = LichSuTiemChung::getInforByUserId();
        $citys = DB::table('locations')->where('type', 1)->get();
        $districts = DB::table('locations')->where('type', 2)->get();
        $wards = DB::table('locations')->where('type', 3)->get();

        return view('admin.user.index', compact('users', 'vaccined', 'citys', 'districts', 'wards'));
    }

    public function editUser($id)
    {
        return view('admin.user.edit');
    }

    public function updateUser(Request $request, $id)
    {
        return 1;
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user) {
            User::destroy($id);

            return redirect()->route('admin.index.user')
                ->with('info', __('Xóa thành công!'));
        } else {
            return redirect()->route('admin.index.user')
                ->with('danger', __('Lỗi! Không tìm thấy người dùng phù hợp.'));
        }

    }

    public function indexTransport()
    {

    }
}
