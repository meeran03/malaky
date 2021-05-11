@extends('admin.layouts.app')
@section('title' , 'إضافة شرط')
@section('content')

<div class="row">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body box bg-cyan ">
                <h4 class="card-title text-white">إضافة شرط</h4>
            </div>
            <div class="comment-widgets">
                <form class="form-horizontal" method="POST" action="{{isset($condition) ? route('admin.conditions.update',[$condition->id]) : route('admin.conditions.store')}}">
                    {!! isset($condition) ? method_field('PATCH') : '' !!}
                    @csrf
                    <div class="card-body">
                        @foreach(app_languages() as $key=>$one)
                        <div class="form-group row">
                            <label for="title-{{ $one['code'] }}" class="col-sm-3 text-right control-label col-form-label"> الشرط {{ $one['title'] }} </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control {{ $errors->has($one['code'].'.title') ? ' is-invalid' : '' }}" id="title-{{ $one['code'] }}" placeholder="الشرط {{ $one['title'] }}" name="{{$one['code']}}[title]" value="{{ isset($condition) ? $condition->translate($one['code'])->title : old($one['code'].'.title')}}">
                                @error($one['code'].'.title')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="border-top">
                        <div class="card-body text-left">
                            <button type="submit" class="btn btn-primary">تأكيد</button>
                            <button type="reset" class="btn btn-warning">إعادة</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection