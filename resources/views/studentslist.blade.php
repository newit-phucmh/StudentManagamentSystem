
<div class="card mb-3">
    <div class="card-body">
      <h5 class="card-title">List of students</h5>
      <p class="card-text">You can find here all the informations about students in the system</p>
      <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Student ID</th>
                <th scope="col">Class</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Age</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($students as $student)
            <tr>
                <td>{{$student->id}}</td>
                <td>{{DB::table('class_objects')->where('id', $student->class_object_id)->value('class_name')}}</td>
                <td>{{$student->firstName.' '.$student->lastName}}</td>
                <td>{{$student->email}}</td>
                <td>{{$student->age}}</td>
                <td>
                     <a href="{{url('admin/student/edit/'.$student->id)}}" class="btn btn-sm btn-warning">Edit</a>
                     <a href="{{url('admin/student/delete/'.$student->id)}}" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{url('admin/student/create')}}" class="btn btn-sm btn-warning">Add student</a>
    </div>
  </div>
        
   







