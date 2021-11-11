<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{url('admin/home')}}">Students Management</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="{{url('admin/home/')}}">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link " href="{{url('admin/student/')}}">Student</a>
            <a class="nav-item nav-link " href="{{url('admin/class/')}}">Class</a>
            <a class="nav-item nav-link " href="{{url('admin/course/')}}">Course</a>
            <a class="nav-item nav-link " href="{{url('admin/checkin')}}">Checkin</a>
            <a class="nav-item nav-link " href="{{url('auth/logout/')}}">Logout</a>
        </div>
    </div>
</nav>