<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Station;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $student_id = DB::table('students')->select('id')->where('user_id', '=', $user_id)->value('id');

        $student = Student::find($user_id);


        $stations = Student::find($student_id)->station;
        return response()->json([
            'student' => $student,
            'stations' => $stations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student([
            'username' => auth()->user()->name,
            'user_id' => auth()->user()->id,
            'reg_no' => $request->input('reg_no'),
            'course' => $request->input('course'),
            'year_study' => $request->input('year_study'),
            'department' => $request->input('department')
        ]);
        $student->save();
        $user_id = auth()->user()->id;
        $student_id = DB::table('students')->select('id')->where('user_id', '=', $user_id)->value('id');

        // student  data

        $sections = [
            'totalUnits' => random_int(52, 64),
            'booksBorrowed' => random_int(25, 40),
            'feeBalance' => 0,
            'sports' => 'cleared',
            'hospital' => 'cleared',
            'roomNumber' => 'MUST' . random_int(100, 500),
        ];

        $station = new Station([
            'student_id' => $student_id,
            'sections' => $sections
        ]);
        $station->save();
        User::find(auth()->user()->id)->update([
            'has_applied' => "1",
        ]);


        return response()->json('Clearance application was successful');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
