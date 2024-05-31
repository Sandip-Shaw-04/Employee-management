<?php

namespace App\Http\Controllers;

use App\Models\Attandence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $attendance = new Attandence();
        $attendance->employee_id = $request->input('employeeId');
        $attendance->start_date = $request->input('startTime');
        $attendance->end_date = $request->input('endTime');
        $attendance->duration = $request->input('duration');
        $attendance->save();

        return response()->json(['message' => 'Attendance recorded successfully!']);
    }
}
