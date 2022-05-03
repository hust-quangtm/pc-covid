<?php

namespace App\Http\Controllers;

use App\Models\PatientInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = PatientInformation::getInforByUserId(Auth()->id());

        return view('users.patient-information.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.patient-information.create');
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
        request()->validate([
            'proof_of_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = new PatientInformation();
        $data['user_id'] = Auth()->id();
        $data['declaration_date'] = $request->declaration_date;

        if ($request->file('proof_of_image')) {
            $file= $request->file('proof_of_image');
            $filename= "image/f0-proof/".date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('image/f0-proof/'), $filename);
            $data['proof_of_image']= $filename;
        }

        $data->save();

        if ($data->save()) {
            return redirect()->route('check-patient.index')->with('success', __('Khai báo thành công!'));
        } else {
            return redirect()->back()->withInput()->with('error', __('Khai báo không thành công!'));
        }
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

        return view('users.patient-information.show', compact('data'));    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = PatientInformation::getInforById($id);

        return view('users.patient-information.edit', compact('data'));
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
            return redirect()->route('check-patient.edit', $id)->with('success', __('Cập Nhật Thành Công'));
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
            return redirect()->route('check-patient.index')
                ->with('info', __('Xóa thành công!'));
        } else {
            return redirect()->route('check-patient.index')
                ->with('error', __('Không thể xóa bản ghi!'));
        }
    }
}
