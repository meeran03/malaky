@extends('admin.layouts.app')
@section('title' , 'طلب خدمة')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body box bg-cyan ">
                <h4 class="card-title text-white">طلب خدمة</h4>
            </div>
            <div class="comment-widgets">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="service_id" class="col-sm-3 text-right control-label col-form-label"> الخدمة </label>
                        <div class="col-sm-9">
                            <input type="text" id="service_id" class="form-control" value="{{ isset($seek->service) ? $seek->service->title : 'لا يوجد' }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 text-right control-label col-form-label"> اسم طالب الخدمة </label>
                        <div class="col-sm-9">
                            <input type="text" id="name" class="form-control" value="{{ $seek->name }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 text-right control-label col-form-label"> البريد الإلكتروني </label>
                        <div class="col-sm-9">
                            <input type="text" id="email" class="form-control" value="{{ $seek->email }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 text-right control-label col-form-label"> الهاتف </label>
                        <div class="col-sm-9">
                            <input type="number" id="phone" class="form-control" value="{{ $seek->phone }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="case_name" class="col-sm-3 text-right control-label col-form-label"> اسم الحالة </label>
                        <div class="col-sm-9">
                            <input type="text" id="case_name" class="form-control" value="{{ $seek->case_name }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="case_age" class="col-sm-3 text-right control-label col-form-label"> عمر الحالة </label>
                        <div class="col-sm-9">
                            <input type="text" id="case_age" class="form-control" value="{{ $seek->case_age }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="details" class="col-sm-3 text-right control-label col-form-label"> شرح عن الحالة </label>
                        <div class="col-sm-9">
                            <input type="text" id="details" class="form-control" value="{{ $seek->details }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <form action="{{route('admin.deliveries.update' , [$seek->id])}}" method="POST" class="d-inline-block">
                            @csrf
                            {{method_field('PATCH')}}
                            <input type="hidden" name="suspend" value="1">
                            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> تم التواصل </button>
                        </form>
                        <form action="{{route('admin.deliveries.update' , [$seek->id])}}" method="POST" class="d-inline-block">
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
                        <label for="" class="col-sm-12 text-right control-label col-form-label"> المرفقات </label>
                        <div class="col-sm-12">
                            <img src="{{isset($seek->attach) ? asset($seek->attach) : asset('adminpanel/assets/images/user.jpg')}}" alt="seek attach" class="hai-img">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 text-right control-label col-form-label"> الحالة </label>
                        <div class="col-sm-9">
                            <h4 id="status">{!! $seek->isActiveTxt !!}</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="messageTime" class="col-sm-3 text-right control-label col-form-label"> توقيت الطلب </label>
                        <div class="col-sm-9">
                            <h4 id="messageTime">{{ isset($seek->created_at) ? $seek->created_at->diffForHumans() : 'لا يوجد' }}</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="messageDate" class="col-sm-3 text-right control-label col-form-label"> تاريخ الطلب </label>
                        <div class="col-sm-9">
                            <h4 id="messageDate">{{ isset($seek->created_at) ? $seek->created_at->format('Y-m-d') : 'لا يوجد' }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
