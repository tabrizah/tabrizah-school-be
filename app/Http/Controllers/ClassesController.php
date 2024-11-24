<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    
    public function index()
    {
        $classes = Classes::with('teacher', 'students')->get(); // Include related teacher and students
        return response()->json([
            'status' => 'success',
            'data' => $classes
        ]);
    }


    public function show($id)
    {
        $class = Classes::with('teacher', 'students')->find($id);

        if (!$class) {
            return response()->json([
                'status' => 'error',
                'message' => 'Class not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $class
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'nullable|exists:teachers,id', // Nullable
        ]);

        // Membuat kelas tanpa total_student karena akan dihitung secara dinamis
        $class = Classes::create([
            'name' => $validatedData['name'],
            'teacher_id' => $validatedData['teacher_id'] ?? null, // Default null
        ]);

        // Menghitung total_student berdasarkan siswa yang terdaftar untuk kelas ini
        $totalStudents = Student::where('class_id', $class->id)->count();

        // Memperbarui total_student pada kelas yang baru dibuat
        $class->update([
            'total_student' => $totalStudents,
        ]);

        return response()->json([
            'message' => 'Class created successfully!',
            'data' => $class,
        ], 201);
    }

    
    public function update(Request $request, $id)
    {
        $class = Classes::find($id);

        if (!$class) {
            return response()->json([
                'status' => 'error',
                'message' => 'Class not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'total_student' => 'integer',
            'teacher_id' => 'exists:teachers,id', 
        ]);

        $class->update($validatedData);

        return response()->json([
            'status' => 'success',
            'data' => $class
        ]);
    }

        public function destroy($id)
    {
        $class = Classes::find($id);

        if (!$class) {
            return response()->json([
                'status' => 'error',
                'message' => 'Class not found'
            ], 404);
        }

        $class->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Class deleted successfully'
        ]);
    }
}