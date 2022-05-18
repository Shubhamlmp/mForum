@extends('layout.master')
@section('title')
Answers
@endsection
@section('section')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="container">
    <div class="page-inner no-page-title">
        <!-- start page main wrapper -->
        <div id="main-wrapper">
            <div class="row">
                <div class="col-lg-5 col-xl-3">
                </div>

                <div class="col-lg-7 col-xl-6">
                    <div class="timeline-comment">
                        <div class="timeline-comment-header">
                            <img src="/storage/photo/{{ $Que_User_image->photo }}"
                                class="avatar" alt="Avatar">
                            <p>{{ App\Models\User::where('id', $queA->add_User_id)->first(['name'])->name }}
                                <small>&nbsp;{{ $queA->created_at->diffForHumans() }}</small>
                            </p>
                        </div>
                        <p class="timeline-comment-text">
                        <h5>{{ $queA->add_question }}</h5>
                        </p>
                    </div>
                    <div class="profile-timeline">
                        <ul class="list-unstyled">
                            @if ($Answers->isNotEmpty())
                                @foreach ($Answers as $ans)
                                    <li class="timeline-item">
                                        <div class="card card-white grid-margin">
                                            {{-- <div class="card-body"> --}}
                                                <div class="timeline-comment">
                                                <div class="timeline-comment-header">
                                                    {{-- @if (Session::has('user')) --}}
                                                    <img src="/storage/photo/{{$Ans_User_image->photo}}"
                                                    class="avatar" alt="Avatar">
                                            {{-- @else
                                                <img src="/storage/photo/user.png"
                                                    class="avatar" alt="Avatar">
                                            @endif --}}
                                                    <p>{{ App\Models\User::getUserNameByID($ans->ans_User_id) }} </p>
                                                    <small> &nbsp; answered at
                                                        {{ \Carbon\Carbon::parse($ans->created_at)->format('M d, Y H:i A') }}</small>
                                                </div>
                                          
                                                <div class="timeline-item-post">
                                                    <p>{!! $ans->add_answer !!}</p>
                                                    <div class="timeline-options">
                                                        <a href="#"><i class="fa fa-comment"></i> Comment below</a>
                                                    </div>
                                                    @foreach ($comments as $comment)
                                                        <div class="timeline-comment">

                                                            <div class="timeline-comment-header">
                                                                <img src="/storage/photo/{{ App\Models\User::where('id', $comment->user_id)->first()['photo'] }}"
                                                                    alt="i" />
                                                                <p>{{ App\Models\User::where('id', $comment->user_id)->first(['name'])->name }}
                                                                    <small>&nbsp;commented
                                                                        {{ $comment->created_at->diffForHumans() }}</small>
                                                                </p>
                                                            </div>
                                                            <p class="timeline-comment-text">
                                                                {{ $comment->comment }}
                                                            </p>

                                                        </div>
                                                    @endforeach
                                                    <div id="timelineC">

                                                    </div>
                                                    <div class="card mt-4">
                                                        <h5 class="card-header">Comments <span
                                                                class="comment-count float-right badge badge-info"></span>
                                                        </h5>
                                                        <div class="card-body">
                                                            {{-- Add Comment --}}
                                                            <div class="add-comment mb-3">
                                                                <form method="POST" id="frm" >
                                                                    @csrf
                                                                    @if(Session::has('user'))
                                                                    <input type="hidden" value="{{Session::get('user')['id']}}" name="user_id">
                                                                    @endif

                                                                    <input type="hidden" name="a_id"
                                                                        value="{{ $ans->a_id }}">
                                                                    <textarea class="form-control comment" name="comment" id="commentInput" placeholder="Enter Comment"></textarea>
                                                                    <span id="errorTag" style="color:red"></span>
                                                                    
                                                                    @if(Session::has('user'))
                                                                    
                                                                    <button type="submit" style="float:right;" data-post=""
                                                                        class="btn btn-dark btn-sm mt-2 save-comment"
                                                                        id="cmtSubmit">Submit</button>
                                                                        @else
                                                                        <a href="{{URL::to('/login')}}" type="button" class="btn btn-dark btn-sm mt-2 save-comment " style="float:right;"> submit</a>
                                                                        @endif
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <div>
                                    <h5 style="text-align: center;">No answers yet</h5>
                                </div>

                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-3">
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('status'))
        <script>
            swal("Successfully Question Added!", "Well done", "success")
        </script>
    @endif
    <div style=" position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background: linear-gradient(to left, #4facfe 0%, #00f2fe 100%) !important;

    color: black;
    text-align: center;">
      <p> Copyright &copy; 2022 All Rights Reserved By
        <a href="contact-us">mForum</a></p>
    </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>


    <script src="/js/formVal.js"></script>
<script>
    jQuery('#frm').submit(function(e) {
    e.preventDefault();
    jQuery.ajax({
        url: "/api/dataComment",
        data: jQuery('#frm').serialize(),
        type: 'POST',
        success: function(result) {
            $('#errorTag').css('display', 'none');
            if (result['status'] == 200) {
                console.log(result);
                var htmlRow =
                    '<div class="timeline-comment"><div class="timeline-comment-header"><img src="/storage/photo/'+result['photo']['photo']+'" alt="" width="30px"/><p>' +
                    result['name']['name'] + '<small> commented ' + result['cmtTime'] +
                    '</small></p></div><p class="timeline-comment-text">' + result['message'][
                        'comment'
                    ] + '</p></div>';
                $('#timelineC').append(htmlRow);
                $('#errorTag').css('display', 'none');
                $('#commentInput').val('');
            } else if (result['status'] == 406) {
                if (result['message']['comment'] != "") {
                    $('#errorTag').css('display', 'block');
                    $('#errorTag').html(result['message']['comment']);
                }
            }

        }
    });
});
</script>
@endsection
