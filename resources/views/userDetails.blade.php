@extends('layout.master')
@section('title')
User Profile
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

                    @foreach ($details as $data)
                    <div class="profile mr-3"><img src="/storage/photo/{{ $data->photo }}" alt="..." width="130"
                            height="100" style="width:10rem; height:10rem; border:3px solid black;"
                            class="rounded mb-2 img-thumbnail">
                    </div>
                    @endforeach

                    @foreach ($details as $data)
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
                    @foreach ($que as $question)
                    <p class="font-italic mb-0">{{ $question->add_question }}</p>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
