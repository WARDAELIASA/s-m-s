<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request as REQ;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::all();
        if (REQ::is('api/*')) {
            return response()->json(["data" => $schools, "message" => "School fetched successfully", "status" => true], 200);
        } else {
            return view('school.index', compact('schools'));
        }
    }
    public function addSchool(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'email' => 'required|exists:users,email',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'location' => 'required',
        ]);

        if ($validator->fails()) {
            if (REQ::is('api/*')) {
                return response()->json(["data" => null, "message" => $validator->errors()->first(), "status" => false], 401);
            } else {
                return redirect()->back()->with('error', $validator->errors()->first());
            }
        }

        $school = School::create($request->all());
        if (REQ::is('api/*')) {
            return response()->json(['data' => $school, "message" => "School added successfully", "status" => true], 200);
        } else {
            return back()->with('success', 'School added successfully');
        }
    }

    public function editSchool(Request $request, School $school)
    {
        $validator = Validator::make($request->all(), [
            // 'email' => 'required|exists:users,email',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'location' => 'required',
        ]);

        if ($validator->fails()) {
            if (REQ::is('api/*')) {
                return response()->json(["data" => null, "message" => $validator->errors()->first(), "status" => false], 401);
            } else {
                return redirect()->back()->with('error', $validator->errors()->first());
            }
        }

        $school = School::update($request->all());
        if (REQ::is('api/*')) {
            return response()->json(['data' => $school, "message" => "School edited successfully", "status" => true], 200);
        } else {
            return back()->with('success', 'School edited successfully');
        }
    }

    public function deleteSchool(School $school)
    {
        $foundSchool = School::find($school->id);
        if ($foundSchool) {
            $foundSchool->delete();
            if (request()->is('api/*')) {
                return response()->json([
                    'data' => $foundSchool,
                    'message' => 'School deleted successfully',
                    'status' => true
                ], 200);
            } else {
                return back()->with('success', 'School deleted successfully');
            }
        } else {
            if (request()->is('api/*')) {
                return response()->json([
                    'data' => null,
                    'message' => 'School not found',
                    'status' => false
                ], 404);
            } else {
                return back()->with('error', 'School not found');
            }
        }
    }
}
