
<div class="card mb-3">
    <img src="https://media.istockphoto.com/vectors/flight-checkin-at-airport-vector-illustration-passengers-cartoon-vector-id1204904641" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Checkins List</h5>
      <p class="card-text">You can find here all the informations in the system</p>
      <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Student ID</th>
                <th scope="col">Name</th>
                <th scope="col">Class</th>
                <th scope="col">Course</th>
                <th scope="col">Email</th>

            </tr>
        </thead>
        
        <tbody>
            @foreach ($checkins as $checkin)
            <tr>
                <td>{{$checkin->user_id}}</td>
                <td>{{DB::table('users')->where('id', $checkin->user_id)->value('firstName').' '.DB::table('users')->where('id', $checkin->user_id)->value('lastName')}}</td>
                <td>{{DB::table('class_objects')->where('id', DB::table('users')->where('id', $checkin->user_id)->value('class_object_id'))->value('class_name')}}</td>
                <td>{{DB::table('courses')->where('id', $checkin->course_id)->value('course_name')}}</td>
                <td>{{DB::table('users')->where('id', $checkin->user_id)->value('email')}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{url('admin/export')}}" class="btn btn-sm btn-warning">Export</a>
    </div>
  </div>