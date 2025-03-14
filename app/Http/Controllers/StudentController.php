<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request as REQ;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $levels = Level::all();

        if (REQ::is('api/*')) {
            return response()->json(['students' => $students], 200);
        } else {
            return view('students.index', compact('students', 'levels'));
        }
    }
    public function addStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'email' => 'required|exists:users,email',
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'level_id' => 'required',
        ]);

        if ($validator->fails()) {
            if (REQ::is('api/*')) {
                return response()->json(["data" => null, "message" => $validator->errors()->first(), "status" => false], 401);
            } else {
                return redirect()->back()->with('error', $validator->errors()->first());
            }
        }

        // $student = Student::create($request->all());
        $student = new Student();; // Assuming you have a post with ID 1

        // Create a new comment and associate it with the post
        $level = Level::find($request->level_id);
        $student->name = $request->name;
        $student->address = $request->address;
        $student->email = $request->email;
        $level->students()->save($student); // Save comment for this post

        if (REQ::is('api/*')) {
            return response()->json(['data' => $student, "message" => "Student added successfully", "status" => true], 200);
        } else {
            return back()->with('success', 'Student added successfully');
        }
    }

    public function editStudent(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            // 'email' => 'required|exists:users,email',
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'level_id' => 'required',
        ]);

        if ($validator->fails()) {
            if (REQ::is('api/*')) {
                return response()->json(["data" => null, "message" => $validator->errors()->first(), "status" => false], 401);
            } else {
                return redirect()->back()->with('error', $validator->errors()->first());
            }
        }

        $student = Student::update($request->all());
        if (REQ::is('api/*')) {
            return response()->json(['data' => $student, "message" => "Student edited successfully", "status" => true], 200);
        } else {
            return back()->with('success', 'Student edited successfully');
        }
    }
    public function deleteStudent(Student $student)
    {
        $foundStudent = Student::find($student->id);
        if ($foundStudent) {
            $foundStudent->delete();
            if (request()->is('api/*')) {
                return response()->json([
                    'data' => $foundStudent,
                    'message' => 'Student deleted successfully',
                    'status' => true
                ], 200);
            } else {
                return back()->with('success', 'Student deleted successfully');
            }
        } else {
            if (request()->is('api/*')) {
                return response()->json([
                    'data' => null,
                    'message' => 'Student not found',
                    'status' => false
                ], 404);
            } else {
                return back()->with('error', 'Student not found');
            }
        }
    }

}
