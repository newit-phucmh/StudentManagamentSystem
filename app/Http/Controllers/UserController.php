<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
     //WEB
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = User::all();
        $data = ['LoggedUserInfo'=>Admin::where('id','=', session('LoggedUser'))->first()];
        return view('admin.student', ['students' => $students, 'layout'=> 'index', 'LoggedUserInfo' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = User::all();
        return view('admin.student', ['students' => $students, 'layout'=> 'create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstName'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12',
            'student_id'=>'required'
        ]);

        $student = new User();
        $student->student_id = $request -> input('student_id');
        $student->class_id = $request -> input('class_id');
        $student->firstName = $request -> input('firstName');
        $student->lastName = $request -> input('lastName');
        $student->age = $request -> input('age');
        $student->email = $request->input('email');
        $student->password = Hash::make($request->input('password'));
        $save=$student->save();
        if ($save){
            return redirect('admin/');
        } else {
            return view('admin.student', ['students' => $students, 'layout'=> 'create']);
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
        $student = User::find($id);
        $students= User::all();
        return view('admin.student',['students'=>$students, 'student'=>$student,'layout'=>'show']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = User::find($id);
        $students= User::all();
        return view('admin.student',['students'=>$students, 'student'=>$student,'layout'=>'edit']);
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
        $request->validate([
            'firstName'=>'required',
            'student_id'=>'required'
        ]);

        $student = User::find($id);
        $student->student_id = $request -> input('student_id');
        $student->class_id = $request -> input('class_id');
        $student->firstName = $request -> input('firstName');
        $student->lastName = $request -> input('lastName');
        $student->age = $request -> input('age');
        $student->email = $request->input('email');
        $student->password = Hash::make($request->input('password'));
        $save = $student->save();

        if ($save){
            return redirect('admin/');
        } else {
            return view('admin.student', ['students' => $students, 'layout'=> 'edit']);
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
        $student = User::find($id);
        $student->delete();
        return redirect('admin/');
    }

    //API
    function register(Request $request){
        //Validate requests
        $validator = Validator::make($request->all(), [
            'firstName'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12',
            'student_id'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

         //Insert data into database
         $student = new User();
         $student->student_id = $request -> input('student_id');
         $student->class_id = $request -> input('class_id');
         $student->firstName = $request -> input('firstName');
         $student->lastName = $request -> input('lastName');
         $student->age = $request -> input('age');
         $student->email = $request->input('email');
         $student->password = Hash::make($request->input('password'));
         $save = $student->save();

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $student,
        ], 200);
    }

    function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
             'password'=>'required|min:5|max:12'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $student = User::where('email','=', $request->email)->first();

        if(!$student){
            return response()->json('Your email is not recognize', 200);
        }else{
            //check token
            if (! $token = auth()->attempt($validator->validated())) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            
            return $this -> createNewToken($token);
            
        }
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL(),
            'user' => auth()->user()
        ]);
    }

}
