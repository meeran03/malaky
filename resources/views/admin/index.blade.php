@extends('admin.layouts.app')
@section('content')
<div class="row">
    @forelse($tabs as $one)
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card card-hover">
            <a href="{{url($one['url'])}}" class="box {{$one['color']}} text-center d-block">
                <h1 class="font-light text-white"><i class="{{$one['icon']}}"></i></h1>
                <h6 class="text-white"><span class="text-white">{{$one['title']}} ( {{$one['count']}} )</span></h6>
            </a>
        </div>
    </div>
    @empty
    @endforelse
</div>


<div class="row">
    @if(admin_can_any('orders'))
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body box bg-cyan">
                <h4 class="card-title text-white">أحدث الطلبات</h4>
            </div>
            <ul class="p-0 m-0">
                @forelse($orders as $key => $one)
                <li class="d-flex no-block card-body">
                    <i class="mdi mdi-blinds font-35"></i>
                    <div>
                        <h6>طلب جديد من {{ $one->user->name }}</h6>
                        <span class="text-muted">{{ isset($one->created_at) ? $one->created_at->diffForHumans() : '' }}</span>
                        <div>
                            <a href="{{route('admin.orders.edit' , [$one->id])}}" class="btn btn-cyan btn-sm"><i class="fas fa-edit"></i></a>
                            {{--<form action="{{route('admin.orders.update' , [$one->id])}}" method="POST" class="d-inline-block">--}}
                                {{--@csrf--}}
                                {{--{{method_field('PATCH')}}--}}
                                {{--<input type="hidden" name="suspend" value="{{ ($one->is_active == 1 ) ? 0 : 1 }}">--}}
                                {{--<button type="submit" class="btn btn-{{ ($one->is_active == 1 ) ? 'warning' : 'success' }} btn-sm"><i class="fas fa-{{ ($one->is_active == 1 ) ? 'times' : 'check' }}"></i></button>--}}
                            {{--</form>--}}
                            {{--<form action="{{route('admin.orders.destroy' , [$one->id])}}" method="POST" class="d-inline-block">--}}
                                {{--@csrf--}}
                                {{--{{method_field('DELETE')}}--}}
                                {{--<button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>--}}
                            {{--</form>--}}
                        </div>
                    </div>
                    <div class="mr-auto">
                        <div class="text-right">
                            <h5 class="text-muted m-b-0">{{ isset($one->created_at) ? $one->created_at->format('d') : 'لا يوجد تاريخ إنشاء' }}</h5>
                            <h5 class="text-muted m-b-0">{{ isset($one->created_at) ? $one->created_at->format('M') : '' }}</h5>
                        </div>
                    </div>

                </li>
                @empty
                <div class="alert alert-danger">لا توجد طلبات ...</div>
                @endforelse
            </ul>
        </div>
    </div>
    @endif
    @if(admin_can_any('notifications'))
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body box bg-cyan">
                <h4 class="card-title text-white">أحدث الإشعارات</h4>
            </div>
            <ul class="list-style-none">
                @forelse(Auth::user()->unreadNotifications()->latest()->take(10)->get() as $key => $one)
                <li class="d-flex no-block card-body">
                    <i class="mdi mdi-bell font-35"></i>
                    <div>
                        <a href="{{ route('admin.notifications.show' , [$one->id]) }}" class="m-b-0 font-medium p-0">{{ $one->data['ar'] }}</a>
                        <span class="text-muted">{{ $one->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="mr-auto">
                        <div class="text-right">
                            <h5 class="text-muted m-b-0">{{ $one->created_at->format('d') }}</h5>
                            <h5 class="text-muted m-b-0">{{ $one->created_at->format('M') }}</h5>
                        </div>
                    </div>
                </li>
                @empty
                <div class="alert alert-danger">لا توجد إشعارات ...</div>
                @endforelse
            </ul>
        </div>
    </div>
    @endif
</div>
@endsection
