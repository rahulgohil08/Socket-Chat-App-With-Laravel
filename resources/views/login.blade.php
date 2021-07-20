<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Socket Chat APP</title>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
          integrity="undefined" crossorigin="anonymous">
</head>


<body>

<div class="container" id="app">

    <div class="row">
        <div class="col-12">
            <div class="card py-3 mt-3">


                <div class="card-body">
                    <h5 class="card-title">Login</h5>


                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="font-weight-bold text-danger">{{$error}}</li>
                        @endforeach
                    </ul>


                    <form class="mt-4" method="post" action="{{route('user.login.submit')}}">

                        @csrf

                        <div class="form-group">
                            <label for="mobile">Enter Mobile</label>
                            <input type="text" class="form-control"
                                   id="mobile" name="mobile_no"
                                   value="{{old('mobile_no')}}" required>

                        </div>


                        <div class="form-group">
                            <label for="password">Enter Password</label>
                            <input type="text"
                                   class="form-control" id="password"
                                   name="password" required>

                        </div>


                        <button type="submit" class="btn btn-primary p-2 mt-3">Let's Login</button>


                    </form>


                </div>
            </div>
        </div>
    </div>


</div>


</body>
</html>







