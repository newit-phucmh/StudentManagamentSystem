<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator; 
use App\Models\Course;

class CourseController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('admin.course', ['courses' => $courses, 'layout'=> 'index']);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        return view('admin.course', ['courses' => $courses, 'layout'=> 'create']);
    }

    public function getClass($id)
    {
        $class = Course::find($id)->classObject;
        return $class;
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
            'course_name'=>'required',
            'class_object_id'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $course = new Course();
        $course->course_name = $request -> input('course_name');
        $course->class_object_id = $request -> input('class_object_id');
        $save=$course->save();

        if ($save){
            return redirect('/admin');
        } else {
            return view('admin.course',['courses'=>$courses, 'layout'=>'create']);
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
        $course = Course::find($id);
        $courses= Course::all();
        return view('admin.course',['courses'=>$courses, 'course'=>$course,'layout'=>'show']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        $courses= Course::all();
        return view('admin.course',['courses'=>$courses, 'course'=>$course,'layout'=>'edit']);
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
        $validator = Validator::make($request->all(), [
            'class_object_id'=>'required',
            'course_name'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $course = Course::find($id);
        $course->course_name = $request -> input('course_name');
        $course->class_object_id = $request -> input('class_object_id');
        $save=$course->save();

        if ($save){
            return redirect('/admin');
        } else {
            return view('admin.course',['courses'=>$courses, 'layout'=>'edit']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        return redirect('/admin');
    }
}
