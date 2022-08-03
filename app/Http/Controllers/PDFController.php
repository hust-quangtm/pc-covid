<?php

namespace App\Http\Controllers;

use App\Models\PatientInformation;
use PDF;

class PDFController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPDF() 
    {
        return view('myPDF');
    }

    public function generatePDF($id, $user_id)
    {
        $patient = PatientInformation::getInforById($id);

        $data = [
            'name' => $patient->user->full_name,
            'birthday' => $patient->user->birthday,
            'id_card' => $patient->user->identify_number,
            'address' => $patient->user->address,
            'infected_day' => $patient->infected_day,
            'date' => date('m/d/Y')
        ];
          
        $pdf = PDF::loadView('myPDF', $data);

//        return $pdf->download('Giay_Chung_Nhan.pdf');
        return $pdf->stream('Giay_Chung_Nhan.pdf');
    }
}
