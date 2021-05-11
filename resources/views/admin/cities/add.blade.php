@extends('admin.layouts.app')
@section('title' , 'إضافة مدينة')
@section('content')
<div class="row">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body box bg-cyan ">
                <h4 class="card-title text-white">إضافة مدينة</h4>
            </div>
            <div class="comment-widgets">
                <form class="form-horizontal" method="POST" action="{{isset($city) ? route('admin.cities.update',[$city->id]) : route('admin.cities.store')}}">
                    {!! isset($city) ? method_field('PATCH') : '' !!}
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="country_id" class="col-sm-3 text-right control-label col-form-label">الدول</label>
                            <div class="col-sm-9">
                                <select class="select2 form-control custom-select {{ $errors->has('country_id') ? ' is-invalid' : '' }}" style="width: 100%; height:36px;" name="country_id" id="country_id">
                                    <option value="">إختر الدولة</option>
                                    @forelse($countries as $one)
                                    <option value="{{$one->id}}" @if( (isset($city) && ($city->country_id == $one->id)) || (old('country_id')== $one->id)) selected @endif>{{$one->title_ar}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('country_id')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title_ar" class="col-sm-3 text-right control-label col-form-label"> اسم المدينة عربي </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control {{ $errors->has('title_ar') ? ' is-invalid' : '' }}" id="title_ar" placeholder="اسم المدينة عربي" name="title_ar" value="{{ isset($city) ? $city->title_ar : old('title_ar')}}">
                                @error('title_ar')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title_en" class="col-sm-3 text-right control-label col-form-label"> اسم المدينة إنجليزي </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control {{ $errors->has('title_en') ? ' is-invalid' : '' }}" id="title_en" placeholder="اسم المدينة إنجليزي" name="title_en" value="{{ isset($city) ? $city->title_en : old('title_en')}}">
                                @error('title_en')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
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
    </div>
</div>
@endsection