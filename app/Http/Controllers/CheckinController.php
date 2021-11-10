<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Checkin;
use App\Models\CheckinInfor;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

use App\Exports\CheckinsExport;
use Maatwebsite\Excel\Facades\Excel;

class CheckinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkins = Checkin::all();
        return view('admin.checkin',['checkins'=>$checkins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new CheckinsExport, 'checkins.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkin(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'course_id'=>'required',
            'user_id'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        

        $checkin = new Checkin();
        $checkin->user_id=$request->user_id;
        $checkin->course_id=$request->course_id;

        
        if (Course::where('id', '=', $request->course_id)->exists()) {
            $checkin_info=new CheckinInfor();
            $checkin_info->user_id=$request->user_id;
            $checkin_info->name=DB::table('users')->where('id', $request->user_id)->value('firstName').' '.DB::table('users')->where('id', $request->user_id)->value('lastName');
            $checkin_info->class=DB::table('class_objects')->where('id', DB::table('users')->where('id', $request->user_id)->value('class_object_id'))->value('class_name');
            $checkin_info->course=DB::table('courses')->where('id', $request->course_id)->value('course_name');
            $checkin_info->email=DB::table('users')->where('id', $request->user_id)->value('email');
            

            $class_req=DB::table('users')->where('id', $request->user_id)->value('class_object_id');
            $class_course=Course::find($request->course_id)->classObject;    

            if ($class_req==$class_course->id) {

                $checkin_info->save();
                $checkin->save();

                $same_data_info = DB::table('checkin_infors')->orderBy('created_at','desc')->where('user_id', $request->user_id);

                if ($same_data_info->count() > 1) {
                    $same_data_before_info = clone $same_data_info;
                    $top_info = $same_data_info->first();
                    $same_data_before_info->where('id', '!=', $top_info->id)->delete();
                }

                $same_data = DB::table('checkins')->orderBy('created_at','desc')->where('user_id', $request->user_id);

                if ($same_data->count() > 1) {
                    $same_data_before = clone $same_data;
                    $top = $same_data->first();
                    $same_data_before->where('id', '!=', $top->id)->delete();
                }
                
                return response()->json([
                    'message' => 'You are successfully check in',
                    'checkin' => $checkin,
                ], 200);
                
                

            } else {
                return response()->json([
                    'message'=>'Your class is not into this course'
                ], 200);
            } 
         } else {
             return response()->json([
                 'message'=>'Course not found'
             ], 200);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
