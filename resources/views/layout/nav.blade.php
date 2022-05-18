<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<nav class="navbar navbar-expand-xl navbar-dark bg-dark sticky-top">
    <a href="{{ url('/dashboard') }}" class="navbar-brand">
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
            <a href="{{ URL::to('/dashboard') }}" class="nav-item "><i class="fa fa-book"></i><span>Dashboard</span></a>
            <a href="{{ URL::to('unAnswered') }}" class="nav-item "><i class="fa fa-pencil"></i><span>Add
                    Answer</span></a>
            @if (Session::has('user'))
            <a href="#" data-toggle="modal" data-target="#exampleModalCenter" class="nav-item "><i class="fa fa-pie-chart"></i><span>Ask Question</span></a>
            @else
            <a href="{{ URL::to('login') }}" class="nav-item "><i class="fa fa-pie-chart"></i><span>Ask
                    Question</span></a>
            @endif
            <div class="nav-item dropdown" style="width: auto;">

                <div class="dropdown-menu">
                    @if(Session::has('user'))
                    <a href="{{ url('/profile') }}" class="dropdown-item"><i class="fa fa-user"></i>
                        Profile</a>
                    <div class="divider dropdown-divider"></div>
                    <a href="{{ URL::to('/logout') }}" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Logout</a>
                    @else
                    <a href="{{ URL::to('/login') }}" class="dropdown-item"><i class="fa fa-sign-in"></i>Login</a>
                    <div class="divider dropdown-divider"></div>
                    <a href="{{ URL::to('/registration') }}" class="dropdown-item"><i class="fa fa-user-plus"></i>Signup</a>
                    @endif
                </div>
                @if(Session::has('user'))
                <a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle user-action" style="margin-right:50px" aria-expanded="true"><img src="/storage/photo/{{ Session::get('user')['photo'] }}" class="avatar" alt="Avatar" style="border-radius: 40%">
                    <span style="color: rgb(39, 35, 35)">{{ Session::get('user')['name'] }}</span> </a>
                @else
                <a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle user-action" style="margin-right:50px" aria-expanded="true"><img src="https://img.icons8.com/bubbles/50/000000/user.png" class="avatar" alt="Avatar">
                    <span style="color: rgb(39, 35, 35)"> User </span> </a>
                @endif
            </div>
        </div>
    </div>
</nav>
<style>
    .dropdown-menu a {
        white-space: normal;
        left: 1000px;
        padding-bottom: 100px;
    }

    .dropdown-menu>li {
        position: relative;
    }

    .dropdown-menu>li>i {
        position: absolute;
        left: 0;
        top: 3px;
    }

    .active {
        background-color: white;
    }
</style>