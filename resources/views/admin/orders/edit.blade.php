@extends('admin.layouts.app')
@section('title' , 'بيانات الطلب')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body box bg-cyan ">
                <h4 class="card-title text-white">بيانات الطلب</h4>
            </div>
            <div class="comment-widgets">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="user" class="col-sm-3 text-right control-label col-form-label"> اسم ولي الأمر </label>
                        <div class="col-sm-9">
                            <h4><a href="{{ route('admin.users.edit' , [$order->user_id]) }}">{{ $order->user->name }}</a></h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="receiver" class="col-sm-3 text-right control-label col-form-label"> اسم الملاذ </label>
                        <div class="col-sm-9">
                            <h4><a href="{{ route('admin.users.edit' , [$order->receiver_id]) }}">{{ $order->receiver->name }}</a></h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="units" class="col-sm-3 text-right control-label col-form-label"> عدد الوحدات </label>
                        <div class="col-sm-9">
                            <input type="number" id="units" class="form-control" value="{{ $order->units }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="details" class="col-sm-3 text-right control-label col-form-label"> تعليق الطلب</label>
                        <div class="col-sm-9">
                            <input type="text" id="details" class="form-control" value="{{ $order->details }}" readonly>
                        </div>
                    </div>
                    @if($order->status_id >= 7)
                    <div class="form-group row">
                        <label for="reason" class="col-sm-3 text-right control-label col-form-label"> سبب الإلغاء </label>
                        <div class="col-sm-9">
                            <input type="text" id="reason" class="form-control" value="{{ $order->reason }}" readonly>
                        </div>
                    </div>
                    @endif
                    <div class="form-group row">
                        <label for="reason" class="col-sm-3 text-right control-label col-form-label"> الاطفال </label>
                        <div class="col-sm-9">
                            <input type="text" id="reason" class="form-control" value="( {{ $order->children->count() }} )
@forelse($order->children as $child) , {{$child->title}}  @empty @endforelse" readonly>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body box bg-success">
                <h4 class="card-title text-white">بيانات إضافية</h4>
            </div>
            <div class="comment-widgets">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="order_date_from" class="col-sm-3 text-right control-label col-form-label"> من  </label>
                        <div class="col-sm-9">
                            <h4 id="order_date_from">{{ isset($order->from) ? date('Y-m-d h:i A', strtotime($order->from)) : 'لا يوجد' }}</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="order_date_to" class="col-sm-3 text-right control-label col-form-label"> إلى  </label>
                        <div class="col-sm-9">
                            <h4 id="order_date_to">{{ isset($order->to) ? date('Y-m-d h:i A', strtotime($order->to)) : 'لا يوجد' }}</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="order_created_diff" class="col-sm-3 text-right control-label col-form-label"> توقيت الإضافة </label>
                        <div class="col-sm-9">
                            <h4 id="order_created_diff">{{ isset($order->created_at) ? $order->created_at->diffForHumans() : 'لا يوجد' }}</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="order_created" class="col-sm-3 text-right control-label col-form-label"> تاريخ الإضافة </label>
                        <div class="col-sm-9">
                            <h4 id="order_created">{{ isset($order->created_at) ? $order->created_at->format('Y-m-d') : 'لا يوجد' }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
