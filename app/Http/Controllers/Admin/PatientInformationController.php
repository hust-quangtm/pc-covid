<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PatientInformation;
use Illuminate\Http\Request;

class PatientInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = PatientInformation::getAllUser();

        return view('users.patient-information.admin.index', compact('datas'));
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
        $data = PatientInformation::getInforById($id);

        return view('users.patient-information.admin.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->route('check-patient.edit', $id);
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
        $data = PatientInformation::getInforById($id);

        $data['declaration_date'] = $request->declaration_date;
        $data['confirm_status'] = $request->confirm_status;
        $data['infected_day'] = $request->infected_day;
        $data['recovery_day'] = $request->recovery_day;

        if ($request->file('proof_of_image')) {
            $file= $request->file('proof_of_image');
            $filename= "image/f0-proof/".date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('image/f0-proof/'), $filename);
            $data['proof_of_image']= $filename;
        }

        $data->save();

        if ($data->save()) {
            return redirect()->route('admin.check-patient.edit', $id)->with('success', __('Cập Nhật Thành Công'));
        } else {
            return redirect()->back()->withInput()->with('error', __('Cập Nhật Thất Bại'));
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
        $data = PatientInformation::getInforById($id);

        if ($data) {
            PatientInformation::destroy($id);
            return redirect()->route('admin.check-patient.index')
                ->with('info', __('Xóa thành công!'));
        } else {
            return redirect()->route('admin.check-patient.index')
                ->with('error', __('Không thể xóa bản ghi!'));
        }
    }
}
