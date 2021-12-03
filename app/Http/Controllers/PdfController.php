<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Station;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $student_id = DB::table('students')->select('id')->where('user_id', '=', $user_id)->value('id');
        $stations = Student::find($student_id)->station;


        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'enable_remote' => true])->setPaper('A4', 'potrait')->loadView('pdf', compact('stations'));
        return $pdf->download('clearance.pdf');
    }
}
