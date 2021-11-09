<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassObject;
use App\Models\Course;
use Validator; 

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = ClassObject::all();
        return view('admin.class', ['classes' => $classes, 'layout'=> 'index']);
    }

    public function getUser()
    {
        $user = ClassObject::find(1)->users;
        return $user;
    }

    public function getCourse()
    {
        $courses = ClassObject::find(2)->courses;
        return $courses;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = ClassObject::all();
        return view('admin.class', ['classes' => $classes, 'layout'=> 'create']);
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
            'class_name'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $class = new ClassObject();
        $class->class_name = $request -> input('class_name');
        $save=$class->save();

        if ($save){
            return redirect('/admin');
        } else {
            return view('admin.class',['classes'=>$classes, 'layout'=>'create']);
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
        $class = ClassObject::find($id);
        $classes= ClassObject::all();
        return view('admin.class',['classes'=>$classes, 'class'=>$class,'layout'=>'show']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class = ClassObject::find($id);
        $classes= ClassObject::all();
        return view('admin.class',['classes'=>$classes, 'class'=>$class,'layout'=>'edit']);
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
            'class_name'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $class = ClassObject::find($id);
        $class->class_name = $request -> input('class_name');
        $save=$class->save();

        if ($save){
            return redirect('/admin');
        } else {
            return view('admin.class',['classes'=>$classes, 'layout'=>'edit']);
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
        $class = ClassObject::find($id);
        $class->delete();
        return redirect('/admin');
    }
}
