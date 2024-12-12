<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // Get all teachers
    public function index()
    {
        $teachers = Teacher::with('user')->get();
        return response()->json(['status' => 'success', 'data' => $teachers]);
    }

    // Get single teacher
    public function show($id)
    {
        $teacher = Teacher::with('user')->find($id);

        if (!$teacher) {
            return response()->json(['status' => 'error', 'message' => 'Teacher not found'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $teacher]);
    }

    // Create a new teacher
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'class_id' => 'nullable|exists:classes,id', // Nullable
        ]);

        $teacher = Teacher::create([
            'name' => $validatedData['name'],
            'user_id' => $validatedData['user_id'],
            'class_id' => $validatedData['class_id'] ?? null, // Default null
        ]);

        return response()->json([
            'message' => 'Teacher created successfully!',
            'data' => $teacher,
        ], 201);
    }

    // Update teacher
    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return response()->json(['status' => 'error', 'message' => 'Teacher not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'class_id' => 'exists:classes,id',
            'user_id' => 'exists:users,id',
        ]);

        $teacher->update($validatedData);

        return response()->json(['status' => 'success', 'data' => $teacher]);
    }

    // Delete teacher
    public function destroy($id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return response()->json(['status' => 'error', 'message' => 'Teacher not found'], 404);
        }

        $teacher->delete();

        return response()->json(['status' => 'success', 'message' => 'Teacher deleted successfully']);
    }
}