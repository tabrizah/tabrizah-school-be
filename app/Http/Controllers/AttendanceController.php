<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    public function index()
    {
        $attendances = Attendance::with('card')->get();
        return response()->json([
          'status' => 'success',
          'data' => $attendances
      ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'card_uid' => 'required|exists:cards,card_uid',
            'status' => 'required|in:present,absent,late',
        ]);

        $attendance = Attendance::create($validated);

        return response()->json([
            'message' => 'Attendance recorded successfully.',
            'data' => $attendance,
        ]);
    }
}