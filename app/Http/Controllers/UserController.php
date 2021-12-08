<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassObject;
use App\Models\Course;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
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
        return view('admin.student', ['students' => $students, 'layout'=> 'index']);
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
            'password'=>'required|min:5|max:12'
        ]);

        $student = new User();
        $student->class_object_id = $request -> input('class_object_id');
        $student->firstName = $request -> input('firstName');
        $student->lastName = $request -> input('lastName');
        $student->age = $request -> input('age');
        $student->email = $request->input('email');
        $student->password = Hash::make($request->input('password'));
        $save=$student->save();
        if ($save){
            return redirect('admin/student');
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
            'firstName'=>'required'
        ]);

        $student = User::find($id);
        $student->class_object_id = $request -> input('class_object_id');
        $student->firstName = $request -> input('firstName');
        $student->lastName = $request -> input('lastName');
        $student->age = $request -> input('age');
        $student->email = $request->input('email');
        $student->password = Hash::make($request->input('password'));
        $save = $student->save();

        if ($save){
            return redirect('admin/student');
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
        return redirect('admin/student');
    }

    

    //API
    function register(Request $request){
        //Validate requests
        $validator = Validator::make($request->all(), [
            'firstName'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

         //Insert data into database
         $student = new User();
         $student->student_id = $request -> input('student_id');
         $student->class_object_id = $request -> input('class_object_id');
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

    function getProfile($id)
    {
       $user = User::where('id', '=', $id)->first();
       if (!$user) {
           return response()->json('User not found', 200);
       } else {
           $class = User::find($id)->classObject;
           return response()->json(
                [
                    'first_name'=>$user->firstName,
                    'last_name' => $user->lastName,
                    'id' => $user->id,
                    'class_name' => $class -> class_name,
                    'class_id' => $user->class_object_id,
                    'age' => $user -> age,
                    'email'=> $user -> email
                ], 
               200);
       }
    }

    
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    protected function createNewToken($token){
        $user = auth()->user();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL(),
            'user_id' => $user->id,
        ]);
    }

    public function getClass($id)
    {
        $class = User::find($id)->classObject;
        return $class;
    }

}
