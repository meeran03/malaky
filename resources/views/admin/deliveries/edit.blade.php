@extends('admin.layouts.app')
@section('title' , 'طلب مندوب')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body box bg-cyan ">
                <h4 class="card-title text-white">طلب مندوب</h4>
            </div>
            <div class="comment-widgets">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 text-right control-label col-form-label"> اسم المرسل </label>
                        <div class="col-sm-9">
                            <input type="text" id="name" class="form-control" value="{{ isset($delivery->user_id) ? $delivery->user->name : 'لا يوجد' }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 text-right control-label col-form-label"> الهاتف </label>
                        <div class="col-sm-9">
                            <input type="number" id="phone" class="form-control" value="{{ $delivery->phone }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <form action="{{route('admin.deliveries.update' , [$delivery->id])}}" method="POST" class="d-inline-block">
                            @csrf
                            {{method_field('PATCH')}}
                            <input type="hidden" name="suspend" value="1">
                            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> تم التواصل </button>
                        </form>
                        <form action="{{route('admin.deliveries.update' , [$delivery->id])}}" method="POST" class="d-inline-block">
                            @csrf
                            {{method_field('PATCH')}}
                            <input type="hidden" name="suspend" value="2">
                            <button type="submit" class="btn btn-warning"><i class="fas fa-times"></i> مرفوض </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body box bg-success">
                <h4 class="card-title text-white">بيانات الطلب</h4>
            </div>
            <div class="comment-widgets">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 text-right control-label col-form-label"> الحالة </label>
                        <div class="col-sm-9">
                            <h4 id="status">{!! $delivery->isActiveTxt !!}</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="messageTime" class="col-sm-3 text-right control-label col-form-label"> توقيت الطلب </label>
                        <div class="col-sm-9">
                            <h4 id="messageTime">{{ isset($delivery->created_at) ? $delivery->created_at->diffForHumans() : 'لا يوجد' }}</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="messageDate" class="col-sm-3 text-right control-label col-form-label"> تاريخ الطلب </label>
                        <div class="col-sm-9">
                            <h4 id="messageDate">{{ isset($delivery->created_at) ? $delivery->created_at->format('Y-m-d') : 'لا يوجد' }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection