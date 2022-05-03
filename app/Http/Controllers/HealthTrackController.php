<?php

namespace App\Http\Controllers;

use App\Models\HealthTrack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HealthTrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = HealthTrack::getInforByUserID(Auth::id());

        return view('users.health-track.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.health-track.create');
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
        $data['user_id'] = Auth::id();
        $data['declaration_date'] = $request->declaration_date;
        $data['session_of_day'] = $request->session_of_day;
        $data['pulse'] = $request->pulse;
        $data['daily_temperature'] = $request->daily_temperature;
        $data['breathing_rate'] = $request->breathing_rate;
        $data['spo2'] = $request->spo2;
        $data['maximum_blood_pressure'] = $request->maximum_blood_pressure;
        $data['minimum_blood_pressure'] = $request->minimum_blood_pressure;
        $data['no_symptoms'] = $request->no_symptoms;
        $data['note'] = $request->note;
        $data['doctor_note'] = $request->doctor_note;

        if ($request->no_symptoms == 0) {
            $data['tired'] = 0;
            $data['cough'] = 0;
            $data['productive_cough'] = 0;
            $data['chills'] = 0;
            $data['conjuntivitis'] = 0;
            $data['loss_of_taste_or_smell'] = 0;
            $data['diarrhea'] = 0;
            $data['hemoptisi'] = 0;
            $data['difficulty_breathing'] = 0;
            $data['chest_tightness'] = 0;
            $data['not_awake'] = 0;
        } else {
            $data['tired'] = $request->tired;
            $data['cough'] = $request->cough;
            $data['productive_cough'] = $request->productive_cough;
            $data['chills'] = $request->chills;
            $data['conjuntivitis'] = $request->conjuntivitis;
            $data['loss_of_taste_or_smell'] = $request->loss_of_taste_or_smell;
            $data['diarrhea'] = $request->diarrhea;
            $data['hemoptisi'] = $request->hemoptisi;
            $data['difficulty_breathing'] = $request->difficulty_breathing;
            $data['chest_tightness'] = $request->chest_tightness;
            $data['not_awake'] = $request->not_awake;
        }

        HealthTrack::create($data);

        return redirect()->route('health-track.index')->with('success', __('Khai báo thành công!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = HealthTrack::getInforById($id);

        return view('users.health-track.edit', compact('data'));
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
        $data = HealthTrack::getInforById($id);

        $data['declaration_date'] = $request->declaration_date;
        $data['session_of_day'] = $request->session_of_day;
        $data['pulse'] = $request->pulse;
        $data['daily_temperature'] = $request->daily_temperature;
        $data['breathing_rate'] = $request->breathing_rate;
        $data['spo2'] = $request->spo2;
        $data['maximum_blood_pressure'] = $request->maximum_blood_pressure;
        $data['minimum_blood_pressure'] = $request->minimum_blood_pressure;
        $data['no_symptoms'] = $request->no_symptoms;
        $data['note'] = $request->note;
        $data['doctor_note'] = $request->doctor_note;

        if ($request->no_symptoms == 0) {
            $data['tired'] = 0;
            $data['cough'] = 0;
            $data['productive_cough'] = 0;
            $data['chills'] = 0;
            $data['conjuntivitis'] = 0;
            $data['loss_of_taste_or_smell'] = 0;
            $data['diarrhea'] = 0;
            $data['hemoptisi'] = 0;
            $data['difficulty_breathing'] = 0;
            $data['chest_tightness'] = 0;
            $data['not_awake'] = 0;
        } else {
            $data['tired'] = $request->tired;
            $data['cough'] = $request->cough;
            $data['productive_cough'] = $request->productive_cough;
            $data['chills'] = $request->chills;
            $data['conjuntivitis'] = $request->conjuntivitis;
            $data['loss_of_taste_or_smell'] = $request->loss_of_taste_or_smell;
            $data['diarrhea'] = $request->diarrhea;
            $data['hemoptisi'] = $request->hemoptisi;
            $data['difficulty_breathing'] = $request->difficulty_breathing;
            $data['chest_tightness'] = $request->chest_tightness;
            $data['not_awake'] = $request->not_awake;
        }

        $data->save();

        if ($data->save()) {
            return redirect()->route('health-track.edit', $id)->with('success', __('Chỉnh sửa thành công!'));
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
        $data = HealthTrack::getInforById($id);

        if ($data) {
            HealthTrack::destroy($id);
            return redirect()->route('health-track.index')
                ->with('info', __('Xóa thành công!'));
        } else {
            return redirect()->route('health-track.index')
                ->with('error', __('Không thể xóa bản ghi!'));
        }
    }
}
