<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request as REQ;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::with('school')->get();
        $schools = School::all();
        if (REQ::is('api/*')) {
            return response()->json(["levels" => $levels]);
        } else {
            return view('level.index', compact('levels', 'schools'));
        }
    }
    public function addLevel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'email' => 'required|exists:users,email',
            'name' => 'required',
            'school_id' => 'required',
        ]);

        // query school by school_id
        // $school->levels()->save($level)

        if ($validator->fails()) {
            if (REQ::is('api/*')) {
                return response()->json(["data" => null, "message" => $validator->errors()->first(), "status" => false], 401);
            } else {
                return redirect()->back()->with('error', $validator->errors()->first());
            }
        }
        // $level= Level::create($request->all());

        $level = new Level();; // Assuming you have a post with ID 1

        // Create a new comment and associate it with the post
        $school = School::find($request->school_id);
        $level->name = $request->name;
        $school->levels()->save($level); // Save comment for this post

        if (REQ::is('api/*')) {
            return response()->json(['data' => $level, "message" => "Level added successfully", "status" => true], 200);
        } else {
            return back()->with('success', 'Level added successfully');
        }
    }

    public function editLevel(Request $request, Level $level)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'school_id' => 'required',
        ]);

        if ($validator->fails()) {
            if (REQ::is('api/*')) {
                return response()->json(["data" => null, "message" => $validator->errors()->first(), "status" => false], 401);
            } else {
                return redirect()->back()->with('error', $validator->errors()->first());
            }        }

        $level->update($request->all());

        if (REQ::is('api/*')) {
            return response()->json(['data' => $level, "message" => "Level edited successfully", "status" => true], 200);
        } else {
            return back()->with('success', 'Level edited successfully');
        }
    }

    public function deleteLevel(Level $level)
    {
        $foundLevel = Level::find($level->id);
        if ($foundLevel) {
            $foundLevel->delete();
            if (request()->is('api/*')) {
                return response()->json([
                    'data' => $foundLevel,
                    'message' => 'Student deleted successfully',
                    'status' => true
                ], 200);
            } else {
                return back()->with('success', 'Level deleted successfully');
            }
        } else {
            if (request()->is('api/*')) {
                return response()->json([
                    'data' => null,
                    'message' => 'Level not found',
                    'status' => false
                ], 404);
            } else {
                return back()->with('error', 'level not found');
            }
        }
    }

}

