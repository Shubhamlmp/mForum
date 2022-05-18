@extends('layout.master')
@section('title')
UnAnswered Question
@endsection
@section('section')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- Summernote JS - CDN Link -->
{{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script> --}}
<!-- Bootstrap 5 CDN Link -->
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<!-- Summernote CSS - CDN Link -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<!-- //Summernote CSS - CDN Link -->

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<div class="container">
    <h1 style="text-align: center; color:#5369f8">UnAnswered Questions</h1>
    <div class="page-inner no-page-title">
        <!-- start page main wrapper -->
        <div id="main-wrapper">
            <div class="row">
                <div class="col-lg-5 col-xl-3">
                </div>
                <div class="col-lg-7 col-xl-6">
                    <div class="profile-timeline">
                        <ul class="list-unstyled">
                            @foreach ($results as $ans)
                            <li class="timeline-item">
                                <div style="padding:0px;" class="card card-white grid-margin">
                                    <div style="padding:0px;" class="card-body">
                                        <div style="padding:0px;" class="timeline-item-header">
                                            <img src="/storage/photo/{{ App\Models\User::where('id', $ans->add_User_id)->first()['photo']; }}" class="avatar"
                                                alt="Avatar">
                                            <p style="margin-top: 0px;">
                                                {{ App\Models\User::getUserNameByID($ans->add_User_id) }} </p>
                                            <p class="text-sm"><span class="op-6">Asked
                                                    {{ \Carbon\Carbon::parse($ans->created_at)->diffForHumans()
                                                    }}</span>
                                            </p>
                                        </div>
                                        <div style="padding:10px;" class="timeline-item-post">
                                            <p id="ques_{{ $ans->que_id }}" style="font-size:large; margin-bottom: 0px">
                                                {{ $ans->add_question }}
                                            </p>
                                            <div style="padding:0px; margin-bottom: 0px;border-bottom: 0px; margin-top: 5px;"
                                                class="timeline-options">
                                                @if(Session::has('user'))
                                                <button onclick="openAnsModal({{ $ans->que_id }})"
                                                    style="border:none;background-color:white;color:#5369f8; float:right;">
                                                    <i class="fa fa-pencil-square-o fa-lg"></i> Answer
                                                </button>
                                                @else
                                                <button onclick="openAnsModal({{ $ans->que_id }})"
                                                    style="border:none;background-color:white;color:#5369f8; float:right;">
                                                    <a href="{{ URL::to('login') }}"> <i class="fa fa-pencil-square-o fa-lg"></i> Answer</a>
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button id="btnToOpenAnsModal" style="display:none;" data-toggle="modal"
                    data-target="#addAnsModal"></button>
                <div class="modal fade" style=" position:fixed;" id="addAnsModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content ">
                            <div class="modal-header"
                                style="background: linear-gradient(to left,#4facfe  0%,#00f2fe  100%) !important;">
                                <h5 class="modal-title" id="exampleModalLongTitle" style="color: black; margin-left:350px;"> <b>Add Answer</b>
                                </h5>
                                <button type="button" style="outline: none;" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    {{-- <span aria-hidden="{{ url('/') }}/addAnssrue">&times;</span> --}}
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="modal-form" action="{{URL::to('addAns')}}" name="myForm"
                                    onsubmit="return validateFormAns()" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-group">
                                            {{-- <div class="col-form-label"> --}}
                                                <h2><label id="message-text" for="message-text"></label></h2>
                                                <input id="quesIdInInput" type="hidden" name="id" value="">
                                            {{-- </div> --}}
                                            {{-- <div style="color:red;" id="error"></div> --}}
                                        </div>
                                        <div class="form-group" >
                                            <label for="message-text" class="col-form-label">Your
                                                Answer : </label>
                                            <textarea class="form-control" id="mySummernote"
                                                name="Summernote"></textarea>
                                            <div style="color:red;" id="required"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="dismissModelBtn" class="btn btn-danger"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row -->
        </div>
        <!-- end page main wrapper -->
    </div>
</div>

<div style=" position: fixed;
left: 0;
bottom: 0;
width: 100%;
background: linear-gradient(to left, #4facfe 0%, #00f2fe 100%) !important;
color: black;
text-align: center;">
    <p> Copyright &copy; 2022 All Rights Reserved By
        <a href="contact-us">mForum</a>
    </p>
</div>

<script>
    $(document).ready(function() {
        $('textarea#mySummernote').summernote({
            placeholder: 'Write Your Answer Here....',
            tabsize: 2,
            height: 150,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear', 'fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link', 'picture', 'hr']],
                ['help', ['help']]
            ],
        });
        $('.dropdown-toggle').dropdown();
    });
</script>
<!-- //Summernote JS - CDN Link -->
<script type="text/javascript">
    $(document).ready(function() {
        let template = null;
        $('.modal').on('show.bs.modal', function(event) {
            template = $(this).html();
        });

        $('.modal').on('hidden.bs.modal', function(e) {
            $(this).html(template);
        });
    });
</script>

<script>
    function validateFormAns() {
        document.getElementById("required").innerHTML = "";
        let y = document.getElementById("mySummernote").value;

        console.log(y);
        if (y == '') {
            document.getElementById("required").innerHTML = "Field is required";
            return false;
        } else {
            return true;
        }
    }
</script>
@if (Session::has('Astatus'))
<script>
    swal("Answer Added Successfully!", "Well Done", "Success")
</script>
@endif

@if (Session::has('status'))
<script>
    swal("Successfully Question Added!", "Well done", "success")
</script>
@endif
<script type="text/javascript">
    var route = "{{ url('autocomplete-search') }}";
    $('#search').typeahead({
        source: function(query, process) {
            return $.get(route, {
                query: query
            }, function(data) {
                return process(data);
            });
        },
        minLength: 3,
        autoSelect: false
    });
</script>

<script>
    function openAnsModal(ansId) {
        getQues = $('#ques_' + ansId).html();
        getQues = getQues.trim();
        console.log(getQues);
        $('#message-text').html(getQues);
        $('#quesIdInInput').val(ansId);
        $('#btnToOpenAnsModal').click();
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        let template = null;
        $('.modal').on('show.bs.modal', function(event) {
            template = $(this).html();
        });

        $('.modal').on('hidden.bs.modal', function(e) {
            $(this).html(template);
        });
    });
</script>

<script>
    function validateForm() {
        document.getElementById("error").innerHTML = "";
        document.getElementById("err").innerHTML = "";
        let x = document.forms["myForm"]["require"].value;
        let y = document.forms["myForm"]["desc"].value;
        if (x == '') {
            document.getElementById("error").innerHTML = "Field is required";
            return false;
        } else if (y == '') {
            document.getElementById("err").innerHTML = "Field is required";
            return false;
        } else {
            return true;
        }
    }
</script>
@endsection
