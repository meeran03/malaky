@extends('admin.layouts.app')
@section('title' , 'إضافة كوبون')
@section('content')
<div class="row">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body box bg-cyan ">
                <h4 class="card-title text-white">إضافة كوبون</h4>
            </div>
            <div class="comment-widgets">
                <form class="form-horizontal" method="POST" action="{{isset($coupon) ? route('admin.coupons.update',[$coupon->id]) : route('admin.coupons.store')}}">
                    {!! isset($coupon) ? method_field('PATCH') : '' !!}
                    @csrf
                    <div class="card-body">

                        <div class="form-group row">
                            <label for="title" class="col-sm-3 text-right control-label col-form-label"> الكوبون </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" placeholder=" الكوبون " name="title" value="{{ isset($coupon) ? $coupon->title : Str::random(5) }}">
                                @error('title')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="units" class="col-sm-3 text-right control-label col-form-label"> عدد الوحدات </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control {{ $errors->has('units') ? ' is-invalid' : '' }}" id="units" placeholder=" عدد الوحدات " name="units" value="{{ isset($coupon) ? $coupon->units : old('units')}}">
                                @error('units')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="from" class="col-sm-3 text-right control-label col-form-label"> من </label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control {{ $errors->has('from') ? ' is-invalid' : '' }}" id="from" placeholder="من" name="from" value="{{ isset($coupon) ? $coupon->from : old('from')}}">
                                @error('from')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="to" class="col-sm-3 text-right control-label col-form-label"> الي </label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control {{ $errors->has('to') ? ' is-invalid' : '' }}" id="to" placeholder="الي" name="to" value="{{ isset($coupon) ? $coupon->to : old('to')}}">
                                @error('to')
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