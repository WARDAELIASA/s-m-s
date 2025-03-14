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
        return response()->json(["data" => $schools, "message" => "School fetched successfully", "status" => true], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return response()->json(['data' => "create form", "message" => "School form retrieved", "status" => true], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            return back()->with('success', 'School stored successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $school = School::find($id);
        return response()->json(['data' => $school, "message" => "School showed successfully with id " .$id, "status" => true], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $school = School::find($id);
          if(!$school){
            return response()->json(["data" => null, "message" => " School not found! ", "status" => false], 404);
          }
          return response()->json(["data" => $school, "message" => "you are going to edit school  ".$school->name, "status" => false], 200);
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
        // $school = School::update($request->all());
        $school = School::find($id);
        return response()->json(["data" => "", "message" => "school ".$school->name." updated", "status" => false], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    public function destroy($id)
    {
        //
        $school = School::find($id);
        return response()->json(["home"=>"successfully school deleted! ".$school->name]);
    }
}




        //


