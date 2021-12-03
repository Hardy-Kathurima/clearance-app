<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Station;
use App\Models\User;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Station::with('student')->get();
        return response()->json($students);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Station::find($id);
        $student->update($request->all());

        $academic = request()->input('academic');
        $finance = request()->input('finance');
        $library = request()->input('library');
        $hostel = request()->input('hostel');


        if ($academic == 1 && $finance == 1 && $library == 1 && $hostel == 1) {
            User::find($request->id)->update([
                'cleared' => "1",
            ]);
        }
        if ($academic == 0 || $finance == 0 || $library == 0 || $hostel == 0) {
            User::find($request->id)->update([
                'cleared' => "0",
            ]);
        }


        return response()->json('student updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Station $id)
    {
        $id->delete();
        return response()->json('student deleted');
    }
}
