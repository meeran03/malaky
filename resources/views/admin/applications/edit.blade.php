@extends('admin.layouts.app')
@section('title' , 'تفاصيل طلب الحاضنة')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body box bg-cyan ">
                <h4 class="card-title text-white">تفاصيل طلب الحاضنة</h4>
            </div>
            <div class="comment-widgets">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 text-right control-label col-form-label"> الحاضنة </label>
                        <div class="col-sm-9">
                            <input type="text" id="name" class="form-control" value="{{ $application->name }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="identity" class="col-sm-3 text-right control-label col-form-label"> رقم الهوية </label>
                        <div class="col-sm-9">
                            <input type="text" id="identity" class="form-control" value="{{ isset($application->identity) ? $application->identity : 'لا يوجد' }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 text-right control-label col-form-label"> البريد الإلكتروني </label>
                        <div class="col-sm-9">
                            <input type="email" id="email" class="form-control" value="{{ isset($application->email) ? $application->email : 'لا يوجد' }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nationality" class="col-sm-3 text-right control-label col-form-label"> الجنسية </label>
                        <div class="col-sm-9">
                            <input type="text" id="nationality" class="form-control" value="{{ isset($application->nationality_id) ? $application->nationality->title_ar : 'لا يوجد' }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 text-right control-label col-form-label"> رقم الجوال </label>
                        <div class="col-sm-9">
                            <input type="text" id="phone" class="form-control" value="{{ $application->phone }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body box bg-cyan ">
                <h4 class="card-title text-white">الحالة الإجتماعية للحاضنة</h4>
            </div>
            <div class="comment-widgets">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="married" class="col-sm-3 text-right control-label col-form-label"> الحالة الاجتماعية </label>
                        <div class="col-sm-9">
                            <input type="text" id="married" class="form-control" value="{{ ($application->married==0)? 'عزباء' : 'متزوجة' }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="has_childrens" class="col-sm-3 text-right control-label col-form-label"> لديه أطفال ؟ </label>
                        <div class="col-sm-9">
                            <input type="text" id="has_childrens" class="form-control" value="{{ ($application->has_childrens==0)? 'لا' : 'نعم' }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-sm-3 text-right control-label col-form-label"> عنوان صاحب الحساب </label>
                        <div class="col-sm-9">
                            <input type="text" id="address" class="form-control" value="{{ isset($application->address) ? $application->address : 'لا يوجد' }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="iban" class="col-sm-3 text-right control-label col-form-label"> رقم الايبان </label>
                        <div class="col-sm-9">
                            <input type="text" id="iban" class="form-control" value="{{ isset($application->iban) ? $application->iban : 'لا يوجد' }}" readonly>
                        </div>
                    </div>

                    @if($application->has_childrens)
                        <div class="form-group row">
                            <label for="childrens" class="col-sm-3 text-right control-label col-form-label"> عدد الأطفال </label>
                            <div class="col-sm-9">
                                <input type="text" id="childrens" class="form-control" value="{{ $application->childrens }}" readonly>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body box bg-info ">
                <h4 class="card-title text-white">المرفقات</h4>
            </div>
            <div class="comment-widgets">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="cv" class="col-sm-3 text-right control-label col-form-label"> السيرة الذاتية </label>
                        <div class="col-sm-9">
                            @if($application->cv)
                                <a href="{{ asset($application->cv) }}" target="_blank">{{ $application->cv }}</a>
                            @else
                                <h4>لا يوجد</h4>
                            @endif </div>
                    </div>
                    <div class="form-group row">
                        <label for="infection" class="col-sm-3 text-right control-label col-form-label"> العدوى </label>
                        <div class="col-sm-9">
                            @if($application->infection)
                                <a href="{{asset($application->infection)}}" target="_blank">{{ $application->infection }}</a>
                            @else
                                <h4>لا يوجد</h4>
                            @endif </div>
                    </div>
                    <div class="form-group row">
                        <label for="criminal" class="col-sm-3 text-right control-label col-form-label"> السجل الجنائي </label>
                        <div class="col-sm-9">
                            @if($application->criminal)
                                <a href="{{asset($application->criminal)}}" target="_blank">{{ $application->criminal }}</a>
                            @else
                                <h4>لا يوجد</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body box bg-success ">
                <h4 class="card-title text-white">حالة الطلب</h4>
            </div>
            <div class="comment-widgets">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="" class="col-sm-5 text-right control-label col-form-label"> الحالة </label>
                        <div class="col-sm-7">
                            <h4>{!! $application->isActiveTxt !!}</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-5 text-right control-label col-form-label"> توقيت الطلب </label>
                        <div class="col-sm-7">
                            <h4>{{ isset($application->created_at) ? $application->created_at->diffForHumans() : 'لا يوجد' }}</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-5 text-right control-label col-form-label"> تاريخ الطلب </label>
                        <div class="col-sm-7">
                            <h4>{{ isset($application->created_at) ? $application->created_at->format('Y-m-d') : 'لا يوجد' }}</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-5 text-right control-label col-form-label"> التحكم الطلب </label>
                        <div class="col-sm-7">
                            @if($application->is_active == 0)
                                <form action="{{route('admin.applications.update' , [$application->id])}}" method="POST" class="d-inline-block">
                                    @csrf
                                    {{method_field('PATCH')}}
                                    <input type="hidden" name="suspend" value="1" placeholder="قبول طلب الإنضمام">
                                    <button type="submit" class="btn btn-success btn-sm">قبول</button>
                                </form>
                                <form action="{{route('admin.applications.update' , [$application->id])}}" method="POST" class="d-inline-block">
                                    @csrf
                                    {{method_field('PATCH')}}
                                    <input type="hidden" name="suspend" value="3" placeholder="رفض طلب الإنضمام">
                                    <button type="submit" class="btn btn-warning btn-sm">رفض</button>
                                </form>
                            @endif
                            <form action="{{route('admin.applications.destroy' , [$application->id])}}" method="POST" class="d-inline-block">
                                @csrf
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
