<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Get all students
    public function index()
    {
        $students = Student::with('user', 'class', 'teacher')->get();
        return response()->json(['status' => 'success', 'data' => $students]);
    }

    // Get single student
    public function show($id)
    {
        $student = Student::with('user', 'class', 'teacher')->find($id);

        if (!$student) {
            return response()->json(['status' => 'error', 'message' => 'Student not found'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $student]);
    }

    // Create a new student
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nisn' => 'required|unique:students,nisn',
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
            'teacher_id' => 'required|exists:teachers,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $student = Student::create($validatedData);

        return response()->json(['status' => 'success', 'data' => $student], 201);
    }

    // Update student
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['status' => 'error', 'message' => 'Student not found'], 404);
        }

        $validatedData = $request->validate([
            'nisn' => 'unique:students,nisn,' . $id,
            'name' => 'string|max:255',
            'class_id' => 'exists:classes,id',
            'teacher_id' => 'exists:teachers,id',
            'user_id' => 'exists:users,id',
        ]);

        $student->update($validatedData);

        return response()->json(['status' => 'success', 'data' => $student]);
    }

    // Delete student
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['status' => 'error', 'message' => 'Student not found'], 404);
        }

        $student->delete();

        return response()->json(['status' => 'success', 'message' => 'Student deleted successfully']);
    }
}