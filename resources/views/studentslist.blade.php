
<div class="card mb-3">
    <img src="https://cdnstepup.r.worldssl.net/wp-content/uploads/2021/02/learn-va-study-3.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">List of students</h5>
      <p class="card-text">You can find here all the informations about students in the system</p>
      <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Class ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Age</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($students as $student)
            <tr>
                <td>{{$student->class_object_id}}</td>
                <td>{{$student->firstName}}</td>
                <td>{{$student->lastName}}</td>
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
    </div>
  </div>
        
   







