<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DangKyTiemChung;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InjectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = DangKyTiemChung::with('user')->get();

        return view('admin.tiem-chung.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DangKyTiemChung::with('user')->find($id);
        $citys = DB::table('locations')->where('type', 1)->get();
        $districts = DB::table('locations')->where('type', 2)->get();
        $wards = DB::table('locations')->where('type', 3)->get();

        // dd($data->toArray());
        return view('admin.tiem-chung.edit', compact('data', 'citys', 'districts', 'wards'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->toArray());
        $dang_ky = DangKyTiemChung::findOrFail($id);

        $dang_ky['ordinal_of_injection'] = $request->ordinalOfInjection;
        $dang_ky['date_of_injection_register'] = $request->dateOfInjectionRegister;
        $dang_ky['part_of_injection_day'] = $request->partOfInjectionDay;
        $dang_ky['date_of_injection'] = $request->dateOfInjection;
        $dang_ky['ordinal_of_injection'] = $request->ordinalOfInjection;
        $dang_ky['injection_address'] = $request->injection_address;
        $dang_ky['status'] = $request->status;
        $dang_ky['note'] = $request->note;

        $dang_ky->save();

        if ($dang_ky->save()) {
            return redirect()->route('admin.tiemchung.edit', $id)
            ->with('success', __('Chỉnh sửa khai báo thành công!'));
        } else {
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
