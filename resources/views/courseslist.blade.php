
<div class="card mb-3">
    <div class="card-body">
      <h5 class="card-title">List of courses</h5>
      <p class="card-text">You can find courses in the system</p>
      <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Course ID</th>
                <th scope="col">Course Name</th>
                <th scope="col">Class in course</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($courses as $course)
            <tr>
                <td>{{$course->id}}</td>
                <td>{{$course->course_name}}</td>
                <td>{{DB::table('class_objects')->where('id', $course->class_object_id)->value('class_name')}}</td>
                <td>
                     <a href="{{url('admin/course/edit/'.$course->id)}}" class="btn btn-sm btn-warning">Edit</a>
                     <a href="{{url('admin/course/delete/'.$course->id)}}" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
  </div>
        
   







