@extends('admin.layouts.app')
@section('title' , 'الرسالة')
@section('content')

<div class="row">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body box bg-cyan ">
                <h4 class="card-title text-white">الرسالة</h4>
            </div>
            <div class="card-body">
                <div class="chat-box scrollable" style="height:475px;">
                    <!--chat Row -->
                    <ul class="chat-list">
                       @forelse($chat->messages as $one)
                        <li class="@if($one->type == 1 ) odd @endIf chat-item">
                            <div class="chat-img"><img src="{{$one->user->imagePath}}" alt="user"></div>
                            <div class="chat-content">
                                <h6 class="font-medium">{{$one->user->name}}</h6>
                                <div class="box bg-light-info">{!! $one->content !!}</div>
                            </div>
                            <div class="chat-time">{{$one->created_at->format('Y-m-d h:i A')}}</div>
                        </li>
                        @empty
                        @endforelse
                    </ul>
                </div>
            </div>
            {{--<div class="card-body border-top">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-9">--}}
                        {{--<div class="input-field m-t-0 m-b-0">--}}
                            {{--<textarea id="textarea1" placeholder="Type and enter" class="form-control border-0"></textarea>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-3">--}}
                        {{--<a class="btn-circle btn-lg btn-cyan float-right text-white" href="javascript:void(0)"><i class="fas fa-paper-plane"></i></a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
@endsection
