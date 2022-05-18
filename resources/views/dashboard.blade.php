{{-- @include('layout.navbar') --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> --}}
@extends('layout.master')
@section('title')
Dashboard
@endsection
@section('section')
<div class="container" style="border-radius: 0px;">
    <div class="row">
        <!-- Main content -->
        <div class="col-lg-9 mb-3">
            <div class="row text-left mb-5">
                <div class="col-lg-6 mb-3 mb-sm-0">
                    <div class="dropdown bootstrap-select form-control form-control-lg bg-white bg-op-9 text-sm w-lg-50" style="width: 100%;">
                        <select id="selectCat" onchange="getThisCat()" class="form-control form-control-lg bg-white bg-op-9 text-sm w-lg-50" data-toggle="select" tabindex="-98">
                            <option value="0"> Categories </option>
                            <option value="1"> Technology </option>
                            <option value="2"> Stocks </option>
                            <option value="3"> Networking </option>
                            <option value="4"> Fashion </option>
                            <option value="5"> Cryptocurrency </option>
                            <option value="6"> Defence </option>
                            <option value="7"> Education </option>
                            <option value="8"> Sports </option>
                        </select>
                    </div>
                </div>
            </div>

            <div id="all_records">
                @if (count($Questions) > 0)
                @foreach ($Questions as $ques)
                <div style="padding-top: 0rem !important; padding-bottom: 0rem !important;" class="card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
                    <div class="row align-items-center">
                        <div class="col-md-8 mb-3 mb-sm-0">
                            <h5>
                                <a href="{{ url('/question/' . $ques->que_id . '/' . $ques->slug) }}" class="text-primary" style="text-decoration: none;">{{ $ques->add_question }}</a>
                            </h5>
                            <p class="text-sm"><span class="op-6">Asked</span> <a class="text-black" href="#">{{
                                \Carbon\Carbon::parse($ques->created_at)->diffForHumans() }}</a>
                                <span class="op-6">by</span> <a class="text-black" href="showUserProfile/{{ $ques->add_User_id }}">{{
                                    App\Models\User::getUserNameByID($ques->add_User_id) }}</a>
                            </p>
                        </div>
                        <div class="col-md-4 op-7">
                            <div class="row text-center op-7">
                                {{-- <div class="col px-1"> <i class="ion-ios-chatboxes-outline icon-1x"></i>
                                    <span class="d-block text-sm">{{ App\Models\Answer::getTotalAns($ques->que_id) }}
                                Answered</span>
                            </div> --}}
                            <div class="col px-1"> <i class="ion-ios-eye-outline icon-1x"></i> <span class="d-block text-sm">{{ App\Models\Question::getTotalCount($ques->que_id) }}
                                    Views</span> </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div>
                <h2>No Questions found</h2>
            </div>
            @endif
        </div>

    </div>
    <!-- Sidebar content -->
    <div class="col-lg-3 mb-4 mb-lg-0 px-lg-0 mt-lg-0">
        <div style="visibility: hidden; display: none; width: 285px; height: 801px; margin: 0px; float: none; position: static; inset: 85px auto auto;">
        </div>
        <div data-settings="{&quot;parent&quot;:&quot;#content&quot;,&quot;mind&quot;:&quot;#header&quot;,&quot;top&quot;:10,&quot;breakpoint&quot;:992}" data-toggle="sticky" class="sticky" style="top: 85px;">
            <div class="sticky-inner">
                <!-- <a class="btn btn-lg btn-block btn-success rounded-0 py-4 mb-3 bg-op-6 roboto-bold" href="#">Ask Question</a> -->
                <div class="bg-white mb-3">
                    <h4 class="px-3 py-4 op-5 m-0" style="background-color: transparent; color: black !important;">
                        Most Viewed Questions
                    </h4>
                    <hr class="m-0">
                    @foreach ($topQues as $topQue)
                    <div class="pos-relative px-3 py-3">
                        <h6 class="text-primary text-sm">
                            <a href="{{ url('/question/' . $topQue->que_id . '/' . $topQue->slug) }}" class="text-primary">{{ $topQue->add_question }}</a>
                        </h6>
                        <p class="mb-0 text-sm"><span class="op-6">Posted</span> <a class="text-black" href="#">{{$topQue->created_at->diffForHumans()}}</a> <span class="op-6">ago
                                by</span> <a class="text-black" href="showUserProfile/{{ $topQue->add_User_id }}">{{
                                    App\Models\User::getUserNameByID($topQue->add_User_id) }}</a></p>
                    </div>
                    <hr class="m-0">
                    @endforeach
                </div>


                <div class="bg-white text-sm">
                    <h4 class="px-3 py-4 op-5 m-0 roboto-bold">
                        Stats
                    </h4>
                    <hr class="my-0">
                    <div class="row text-center d-flex flex-row op-7 mx-0">
                        <div class="col-sm-6 flex-ew text-center py-3 border-bottom border-right"> <a class="d-block lead font-weight-bold" href="#">{{ App\Models\Category::count()
                                    }}</a> Topics </div>
                        <div class="col-sm-6 col flex-ew text-center py-3 border-bottom mx-0"> <a class="d-block lead font-weight-bold" href="#">{{ App\Models\Question::count()
                                    }}</a> Questions </div>
                    </div>
                    <div class="row d-flex flex-row op-7">
                        <div class="col-sm-6 flex-ew text-center py-3 border-right mx-0"> <a class="d-block lead font-weight-bold" href="#">
                                {{ App\Models\User::count() }}
                            </a>
                            Members </div>
                        <div class="col-sm-6 flex-ew text-center py-3 mx-0"> <a class="d-block lead font-weight-bold" href="showUserProfile/{{App\Models\User::latest()->first()->id}}">
                                {{App\Models\User::latest()->first()->name }}
                            </a> Newest Member
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

{{-- @include('layout.footer') --}}

@include('layout.dashboardScript')
@endsection