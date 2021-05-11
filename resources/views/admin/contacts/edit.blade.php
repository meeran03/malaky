@extends('admin.layouts.app')
@section('title' , 'جهة الاتصال')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body box bg-cyan ">
                <h4 class="card-title text-white">جهة الاتصال</h4>
            </div>
            <div class="comment-widgets">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 text-right control-label col-form-label"> اسم المرسل </label>
                        <div class="col-sm-9">
                            <input type="text" id="name" class="form-control" value="{{ isset($contact->user_id) ? $contact->user->name : 'لا يوجد' }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-3 text-right control-label col-form-label"> نوع الرسالة </label>
                        <div class="col-sm-9">
                            <input type="email" id="type" class="form-control" value="{{ $contact->type }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message" class="col-sm-3 text-right control-label col-form-label"> محتوى الرسالة </label>
                        <div class="col-sm-9">
                            <textarea id="message" class="form-control" readonly>{{ $contact->message }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reply" class="col-sm-3 text-right control-label col-form-label"> الرد </label>
                        <div class="col-sm-9">
                            @if(isset($contact->reply))
                            <textarea id="reply" class="form-control" readonly>{{ $contact->reply }}</textarea>
                            @else
                            <form class="form-horizontal" method="POST" action="{{ route('admin.contacts.update',[$contact->id]) }}">
                                {!! isset($contact) ? method_field('PATCH') : '' !!}
                                @csrf
                                <textarea class="form-control" name="reply" placeholder="الرد">{{ $contact->reply }}</textarea>
                                <div class="border-top">
                                    <div class="card-body text-left">
                                        <button type="submit" class="btn btn-primary">تأكيد</button>
                                        <button type="reset" class="btn btn-warning">إعادة</button>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body box bg-success">
                <h4 class="card-title text-white">بيانات الاتصال</h4>
            </div>
            <div class="comment-widgets">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 text-right control-label col-form-label"> الهاتف </label>
                        <div class="col-sm-9">
                            <input type="number" id="phone" class="form-control" value="{{ $contact->phone }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 text-right control-label col-form-label"> البريد الالكترونى </label>
                        <div class="col-sm-9">
                            <input type="email" id="email" class="form-control" value="{{ $contact->email }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 text-right control-label col-form-label"> الحالة </label>
                        <div class="col-sm-9">
                            <h4 id="status">{!! $contact->isRepliedTxt !!}</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="messageTime" class="col-sm-3 text-right control-label col-form-label"> توقيت الرسالة </label>
                        <div class="col-sm-9">
                            <h4 id="messageTime">{{ isset($contact->created_at) ? $contact->created_at->diffForHumans() : 'لا يوجد' }}</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="messageDate" class="col-sm-3 text-right control-label col-form-label"> تاريخ الرسالة </label>
                        <div class="col-sm-9">
                            <h4 id="messageDate">{{ isset($contact->created_at) ? $contact->created_at->format('Y-m-d') : 'لا يوجد' }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection