@extends('admin.layouts.app')
@section('title' , 'إضافة باقة')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    هناك خطأ ، يرجى مراجعة البيانات المدرجة
</div>
@endif

<div class="row">
    <!-- column -->
    <div class="col-lg-12">
        <form class="form-horizontal" method="POST" action="{{isset($package) ? route('admin.packages.update',[$package->id]) : route('admin.packages.store')}}">
            {!! isset($package) ? method_field('PATCH') : '' !!}
            @csrf
            <div class="card">
                <div class="card-body box bg-cyan ">
                    <h4 class="card-title text-white">إضافة باقة</h4>
                </div>

                <ul class="nav nav-tabs" role="tablist">
                    @foreach(app_languages() as $key=>$one)
                    <li class="nav-item"> <a class="nav-link @if($key == 0 ) active @endif" data-toggle="tab" href="#tab-{{$one['code']}}" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">{{ $one['title'] }}</span></a> </li>
                    @endforeach
                </ul>

                <div class="tab-content tabcontent-border">
                    @foreach(app_languages() as $key=>$one)
                    <div class="tab-pane @if($key == 0 ) active @endif" id="tab-{{$one['code']}}" role="tabpanel">

                        <div class="card-body">
                            <div class="form-group row">
                                <label for="{{$one['code']}}[title]" class="col-sm-3 text-right control-label col-form-label">اسم الباقة {{$one['title']}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{ $errors->has($one['code'].'.title') ? ' is-invalid' : '' }}" id="{{$one['code']}}[title]" placeholder="اسم الباقة  {{$one['title']}}" name="{{$one['code']}}[title]" value="{{ isset($package) ? $package->translate($one['code'])->title : old($one['code'].'.title')}}">
                                    @error($one['code'].'.title')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="{{$one['code']}}[feature_1]" class="col-sm-3 text-right control-label col-form-label">الميزة الأولى {{$one['title']}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{ $errors->has($one['code'].'.feature_1') ? ' is-invalid' : '' }}" id="{{$one['code']}}[feature_1]" placeholder="الميزة الأولى {{$one['title']}}" name="{{$one['code']}}[feature_1]" value="{{ isset($package) ? $package->translate($one['code'])->feature_1 : old($one['code'].'.feature_1')}}">
                                    @error($one['code'].'.feature_1')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="{{$one['code']}}[feature_2]" class="col-sm-3 text-right control-label col-form-label">الميزة الثانية {{$one['title']}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{ $errors->has($one['code'].'.feature_2') ? ' is-invalid' : '' }}" id="{{$one['code']}}[feature_2]" placeholder="الميزة الثانية {{$one['title']}}" name="{{$one['code']}}[feature_2]" value="{{ isset($package) ? $package->translate($one['code'])->feature_2 : old($one['code'].'.feature_2')}}">
                                    @error($one['code'].'.feature_2')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="{{$one['code']}}[feature_3]" class="col-sm-3 text-right control-label col-form-label">الميزة الثالثة {{$one['title']}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{ $errors->has($one['code'].'.feature_3') ? ' is-invalid' : '' }}" id="{{$one['code']}}[feature_3]" placeholder="الميزة الثالثة {{$one['title']}}" name="{{$one['code']}}[feature_3]" value="{{ isset($package) ? $package->translate($one['code'])->feature_3 : old($one['code'].'.feature_3')}}">
                                    @error($one['code'].'.feature_3')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="{{$one['code']}}[feature_4]" class="col-sm-3 text-right control-label col-form-label">الميزة الرابعة {{$one['title']}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{ $errors->has($one['code'].'.feature_4') ? ' is-invalid' : '' }}" id="{{$one['code']}}[feature_4]" placeholder="الميزة الثانية {{$one['title']}}" name="{{$one['code']}}[feature_4]" value="{{ isset($package) ? $package->translate($one['code'])->feature_4 : old($one['code'].'.feature_4')}}">
                                    @error($one['code'].'.feature_4')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                    </div>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="card-body box bg-cyan ">
                    <h4 class="card-title text-white"> معلومات أساسية </h4>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="type_id" class="col-sm-3 text-right control-label col-form-label">نوع الباقة</label>
                        <div class="col-sm-9">
                            <select class="select2 form-control custom-select {{ $errors->has('type_id') ? ' is-invalid' : '' }}" style="width: 100%; height:36px;" name="type_id" id="type_id">
                                @forelse($types as $one)
                                @if($one->id == 1)
                                <option value="{{$one->id}}" @if( (isset($package) && ($package->type_id == $one->id)) || (old('type_id')== $one->id)) selected @endif>{{$one->translate('ar')->title}}</option>
                                @endif
                                @empty
                                @endforelse
                            </select>
                            @error('type_id')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="units" class="col-sm-3 text-right control-label col-form-label"> عدد الوحدات </label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control {{ $errors->has('units') ? ' is-invalid' : '' }}" id="units" placeholder=" عدد الوحدات " name="units" value="{{ isset($package) ? $package->units : old('units') }}">
                            @error('units')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-sm-3 text-right control-label col-form-label"> سعر الباقة </label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" id="price" placeholder=" سعر الباقة " name="price" value="{{ isset($package) ? $package->price : old('price') }}">
                            @error('price')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                </div>
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
@endsection