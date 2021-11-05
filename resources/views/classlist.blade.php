
<div class="card mb-3">
    <div class="card-body">
      <h5 class="card-title">List of classes</h5>
      <p class="card-text">You can find here all the informations about classes in the system</p>
      <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Class ID</th>
                <th scope="col">Class Name</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($classes as $class)
            <tr>
                <td>{{$class->id}}</td>
                <td>{{$class->class_name}}</td>
                <td>
                     <a href="{{url('admin/class/edit/'.$class->id)}}" class="btn btn-sm btn-warning">Edit</a>
                     <a href="{{url('admin/class/delete/'.$class->id)}}" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
  </div>
        
   







