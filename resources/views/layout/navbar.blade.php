<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link rel="stylesheet" href="css/footer.css">
    <link href="{{ asset('css/mforum.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-xl navbar-dark bg-dark sticky-top">
        <a href="{{ url('dashboard') }}" class="navbar-brand">
            <img src="https://github.com/Shubhamlmp/vragen/blob/main/mForumMain.png?raw==true" alt="">
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
            <form action="{{ route('search') }}" method="GET" class="navbar-form form-inline">
                <div class="input-group search-box">
                    <input type="text" id="search" autocomplete="off" class="form-control" placeholder="Search your Query..." name="search">
                    <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
                </div>
            </form>

            <div class="navbar-nav ml-auto">
                <a href="{{ url('home') }}" class="nav-item "><i class="fa fa-home"></i><span>Home</span></a>
                <a href="{{ route('unAnswered') }}" class="nav-item "><i class="fa fa-pencil"></i><span>Add Answer</span></a>
                @if (Session::has('loginID'))
                <a href="" data-toggle="modal" data-target="#exampleModalCenter" class="nav-item "><i class="fa fa-pie-chart"></i><span>Ask Question</span></a>
                @else
                <a href="{{ url('login') }}" class="nav-item "><i class="fa fa-pie-chart"></i><span>Ask
                        Question</span></a>
                @endif

                <div class="nav-item dropdown">
                    @if (Session::has('loginID'))
                    <a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle user-action">
                        {{-- <img src="https://img.icons8.com/bubbles/50/000000/user.png" class="avatar" alt="Avatar"> --}}
                        @if (Session::get('userDetails')['photo'] == 'https://t4.ftcdn.net/jpg/02/15/84/43/240_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg')
                        <img src="{{url('/')}}/{{ Session::get('userDetails')['photo'] }}" class="avatar" alt="Avatar">
                        @else
                        <img src="storage/photo/{{ Session::get('userDetails')['photo'] }}" class="avatar" alt="Avatar">
                        @endif
                        {{ App\Models\User::find(session()->get('loginID'))->name }}
                    </a>

                    <div class="dropdown-menu">
                        <a href="{{ url('/profile') }}" class="dropdown-item"><i class="fa fa-user"></i>
                            Profile</a>

                        <div class="divider dropdown-divider"></div>
                        <a href="logout" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Logout</a>
                    </div>
                    @else
                    <a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle user-action"><img src="https://img.icons8.com/bubbles/50/000000/user.png" class="avatar" alt="Avatar">
                        User</a>
                    <div class="dropdown-menu">
                        <a href="{{ URL::to('/login') }}" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Login</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="modal fade" style=" position:fixed;" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(to left,#4facfe  0%,#00f2fe  100%) !important;">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: black;"> Ask Question</h5>
                    <button type="button" style="outline: none;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form class="modal-form" action="{{ url('/') }}/data" name="myForm" onsubmit="return validateForm()" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="form-group">
                                <div class="col-form-label">
                                    <label for="message-text">Category</label>
                                </div>

                                <div class="col-75">
                                    <select id="require" name="category">
                                        <option value="">select your Category</option>
                                        <option name=" ">Technology</option>
                                        <option name=" ">Stocks</option>
                                        <option name=" ">Networking </option>
                                        <option name=" ">Fashion </option>
                                        <option name=" ">Cryptocurrency</option>
                                        <option name=" ">Defence </option>
                                        <option name=" ">Education</option>
                                        <option name=" ">Sports</option>
                                    </select>
                                </div>
                                <div style="color:red;" id="error"></div>
                            </div>

                            <div class="form-group" id="xyz">
                                <label for="message-text" class="col-form-label">Add Question:</label>
                                <textarea class="form-control" name="des" placeholder="Start your Question with ' What ',' How ',' Why ' ect." id="desc"></textarea>
                                <div style="color:red;" id="err"></div>
                            </div>


                            <div class="modal-footer">
                                <button type="button" id="dismissModelBtn" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>