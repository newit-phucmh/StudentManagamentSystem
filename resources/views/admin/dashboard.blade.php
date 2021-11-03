<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-3.1.1/css/bootstrap.min.css') }}">
</head>
<body>
    
    <div class="container">
         <div class="row">
            <div class="col-md-6 col-md-offset-3">
                   <h4>Dashboard</h4><hr>
                   <div class="row">
                     <div class="p">Welcome {{$LoggedUserInfo['name']}}</div>
                     <td><a href="{{ route('auth.logout') }}">Logout</a></td>
                   </div>
                   
            </div>
         </div>
    </div>
</body>
</html>