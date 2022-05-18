
@extends('layout.master')
@section('title')
profile
@endsection
@section('section')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        .profile-head {
            transform: translateY(5rem)
        }
        .cover {
            background-image: url(https://images.unsplash.com/photo-1530305408560-82d13781b33a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1352&q=80);
            background-size: cover;
            background-repeat: no-repeat
        }
    </style>

    <div class="row py-5 px-4">
        <div class="col-md-5 mx-auto">
            <!-- Profile widget -->
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 cover">
                    <div class="media align-items-end profile-head">

                        @if (Session::has('user'))
                            <div class="profile mr-3"><img src="/storage/photo/{{ Session::get('user')['photo'] }}" alt="..."
                                    width="130" height="100" style="width:10rem; height:10rem; border:3px solid black;"
                                    class="rounded mb-2 img-thumbnail">
                            @else
                                <div class="profile mr-3"><img
                                        src="/storage/photo/user.png" alt="..."
                                        width="130" height="100"
                                        style="width:10rem; height:10rem; border:3px solid black;"
                                        class="rounded mb-2 img-thumbnail">
                        @endif
                        @foreach ($details as $data)
                            <a href="" class="btn btn-outline-dark btn-sm btn-block" data-toggle="modal"
                                data-target="#exampleModal-{{ $data->id }}" data-whatever="@mdo">Edit profile</a>
                    </div>
                    <div class="media-body mb-5 text-white">
                        <h4 class="mt-0 mb-0">{{ $data->name }}</h4>
                        <p class="small mb-4"> <i class="fas fa-map-marker-alt mr-2"></i>{{ $data->email }}</p>
                        <p class="small mb-4"> <i class="fas fa-map-marker-alt mr-2"></i>{{ $data->designation }}
                        </p>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="bg-light p-4 d-flex justify-content-end text-center">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">{{ $res }}</h5><small class="text-muted">
                            Question posted</small>
                    </li>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">{{ $a }}</h5><small class="text-muted">
                            Answers posted </small>
                    </li>
                </ul>
            </div>

            <br>

            <div class="px-4 py-3">
                <h5 class="mb-0">Questions</h5>
                <br>
                <div class="p-4 rounded shadow-sm bg-light" id="data">
                    {{-- <p class="font-italic mb-0">Web Developer</p> --}}
                    @foreach ($que as $question)
                        <p class="font-italic mb-0">{{ $question->add_question }}</p>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal-{{ $data->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel-{{ $data->id }} aria-hidden=" true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"
                    style="background: linear-gradient(to left,#4facfe  0%,#00f2fe  100%) !important;">
                    <h5 class="modal-title" id="exampleModalLabel-{{ $data->id }}">Edit Your Profile Here</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/profile/data" name="data" onsubmit="return formValidate()" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div style="color:red;" id="a_error"></div>
                            <input type="hidden" name="id" value="{{ $data->id }}" class="form-control">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" name="name" id="u_name" value="{{ $data->name }}" class="form-control"
                                id="user_name">
                            <div style="color:red;" id="name_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Email:</label>
                            <input type="text" name="email" id="u_email" value="{{ $data->email }}" class="form-control"
                                id="user_email">
                            <div style="color:red;" id="email_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Contact Number:</label>
                            <input type="text" name="phone" value="{{ $data->contact }}" class="form-control"
                                id="user_phone">
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Designation:</label>
                            <input type="text" name="designation" value="{{ $data->designation }}"
                                class="form-control" id="user_designation">
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Image:</label>
                            <input type="file" name="image" class="form-control" id="user_designation">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if (Session::has('status1'))
        <script>
            swal("Details Updated Successfully!", "Well done", "success")
        </script>

    @endif
  
    @endsection
    <script>
        function errorShow(a,b){
            document.getElementById(a).innerHTML = "Field is required";
        }
        function formValidate(){
            uname = $('#u_name').val();
            uemail = $('#u_email').val();
            if(uname=="" && uemail==""){
                errorShow('name_error','name can\'t be empty')
                errorShow('email_error','name can\'t be empty')
                return false;
            }else if(uname==""){
                errorShow('name_error','name can\'t be empty')
                return false;
            }else if(uemail==""){
                errorShow('email_error','name can\'t be empty')
                return false;
            }else{
                return true;
            }

        }
    </script>