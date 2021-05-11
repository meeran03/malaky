@extends('staticpage.layouts.app')
@section('title')
    @if($lang == 'ar')
        نموذج توثيق حاضنة
    @else
        Babysitter Application Form
    @endif
@endsection
@section('content')
    <section id="section-1-1" class="hero hero-bg-1 layout-2">
        <div class="container">
            <form class="form-horizontal" method="POST" action="{{ url('applications') }}" enctype="multipart/form-data">
    @csrf
    <div class="outer clearfix z-1 relative">
        @include('staticpage.layouts.alert')
        <h2 class="b20-1 text-center">
            <span class="strong">
                @if($lang == 'ar')
                    نموذج توثيق حاضنة
                @else
                    Babysitter Application Form
                @endif
            </span>
        </h2>
        <div class="row">
            <!-- column -->
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="comment-widgets">
                        <div class="card-body">
                            <div class="form-group row flex">
                                <label for="name" class="col-sm-4 text-right control-label col-form-label">
                                    @if($lang == 'ar')
                                    الاسم كامل
                                    @else
                                    Full Name
                                    @endif
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" placeholder="{{ ($lang == 'ar') ? 'الاسم كامل' : 'Full Name' }}" name="name" value="{{ old('name')}}">
                                    @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row flex">
                                <label for="identity" class="col-sm-4 text-right control-label col-form-label">
                                    @if($lang == 'ar')
                                    رقم الهوية
                                    @else
                                    Identity Number
                                    @endif
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control {{ $errors->has('identity') ? ' is-invalid' : '' }}" id="identity" placeholder="{{ ($lang == 'ar') ? 'رقم الهوية' : 'Identity Number' }}" name="identity" value="{{ old('identity')}}">
                                    @error('identity')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row flex">
                                <label for="email" class="col-sm-4 text-right control-label col-form-label">
                                    @if($lang == 'ar')
                                    البريد الالكتروني
                                    @else
                                    Email
                                    @endif
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" placeholder="{{ ($lang == 'ar') ? 'البريد الالكتروني' : 'Email' }}" name="email" value="{{ old('email')}}">
                                    @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row flex">
                                <label for="nationality_id" class="col-sm-4 text-right control-label col-form-label">
                                    @if($lang == 'ar')
                                    الجنسية
                                    @else
                                    Nationality
                                    @endif
                                </label>
                                <div class="col-sm-8">
                                    <select class="select2 form-control custom-select {{ $errors->has('nationality_id') ? ' is-invalid' : '' }}" style="width: 100%; height:36px;padding:0px 24px" name="nationality_id" id="nationality_id">
                                        @forelse($nationalities as $one)
                                        <option value="{{$one->id}}" @if( (isset($application) && ($application->nationality_id == $one->id)) || (old('nationality_id')== $one->id)) selected @elseif ( $one->id == 194)) selected  @endif>
                                            @if($lang == 'ar')
                                            {{$one->title_ar}}
                                            @else
                                            {{$one->title_en}}
                                            @endif
                                        </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('nationality_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row flex">
                                <label for="phone" class="col-sm-4 text-right control-label col-form-label">
                                    @if($lang == 'ar')
                                    رقم الجوال
                                    @else
                                    Phone
                                    @endif
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" id="phone" placeholder="{{ ($lang == 'ar') ? 'رقم الجوال' : 'Phone' }}" name="phone" value="{{ old('phone')}}">
                                    @error('phone')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="comment-widgets">
                        <div class="card-body">
                            <div class="form-group row flex">
                                <label for="iban" class="col-sm-4 text-right control-label col-form-label">
                                    @if($lang == 'ar')
                                    رقم الايبان
                                    @else
                                    Iban
                                    @endif
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control {{ $errors->has('iban') ? ' is-invalid' : '' }}" id="iban" placeholder="{{ ($lang == 'ar') ? 'رقم الايبان' : 'Iban' }}" name="iban" value="{{ old('iban')}}">
                                    @error('iban')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row flex">
                                <label for="address" class="col-sm-4 text-right control-label col-form-label">
                                    @if($lang == 'ar')
                                    عنوان صاحب الحساب
                                    @else
                                    Address
                                    @endif
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" id="address" placeholder="{{ ($lang == 'ar') ? 'عنوان صاحب الحساب' : 'Address' }}" name="address" value="{{ old('address')}}">
                                    @error('address')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row flex">
                                <label for="married" class="col-sm-4 text-right control-label col-form-label">
                                    @if($lang == 'ar')
                                    الحالة الاجتماعية
                                    @else
                                    Marital Status
                                    @endif
                                </label>
                                <div class="col-md-9">
                                    <div class="custom-control custom-radio d-inline-block">
                                        <input type="radio" class="custom-control-input {{ $errors->has('married') ? ' is-invalid' : '' }}" id="married" name="married" value="1" @if(old('married') == 1) checked @endif>
                                        <label class="custom-control-label" for="married">
                                            @if($lang == 'ar')
                                            متزوجة
                                            @else
                                            Married
                                            @endif
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio d-inline-block">
                                        <input type="radio" class="custom-control-input {{ $errors->has('married') ? ' is-invalid' : '' }}" id="single" name="married" value="0" @if(old('married') == 0) checked @endif>
                                        <label class="custom-control-label" for="single">
                                            @if($lang == 'ar')
                                            عزباء
                                            @else
                                            Single
                                            @endif
                                        </label>
                                    </div>
                                </div>
                                @error('married')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row flex">
                                <label for="has_childrens" class="col-sm-4 text-right control-label col-form-label">
                                    @if($lang == 'ar')
                                    هل يوجد بمقر الاحتضان أطفال وما هو عددهم ؟
                                    @else
                                    Is there any children in the nursery ?
                                    @endif
                                </label>
                                <div class="col-md-9">
                                    <div class="custom-control custom-radio d-inline-block">
                                        <input type="radio" class="custom-control-input {{ $errors->has('has_childrens') ? ' is-invalid' : '' }}" id="yes" name="has_childrens" value="1" @if(old('has_childrens') == 1) checked @endif>
                                        <label class="custom-control-label" for="yes">
                                            @if($lang == 'ar')
                                            نعم
                                            @else
                                            Yes
                                            @endif
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio d-inline-block">
                                        <input type="radio" class="custom-control-input {{ $errors->has('has_childrens') ? ' is-invalid' : '' }}" id="no" name="has_childrens" value="0" @if(old('has_childrens') == 0) checked  @endif>
                                        <label class="custom-control-label" for="no">
                                            @if($lang == 'ar')
                                            لا
                                            @else
                                            No
                                            @endif
                                        </label>
                                    </div>

                                    @error('has_childrens')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row flex">
                                <label for="childrens" class="col-sm-4 text-right control-label col-form-label">
                                    @if($lang == 'ar')
                                    اذا كانت الاجابة نعم كم هو عددهم ؟
                                    @else
                                    If answer was yes, how many of them ?
                                    @endif
                                </label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control {{ $errors->has('childrens') ? ' is-invalid' : '' }}" id="childrens" placeholder="{{ ($lang == 'ar') ? 'عدد الاطفال' : 'Number of Childrens' }}" name="childrens" value="{{ old('childrens')}}">
                                    @error('childrens')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="comment-widgets">
                        <div class="card-body">
                            <div class="form-group row flex">
                                <label for="cv" class="col-sm-4 text-right control-label col-form-label">
                                    @if($lang == 'ar')
                                    السيرة الذاتية ( ان وجدت )
                                    @else
                                    CV (if exist)
                                    @endif
                                </label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control {{ $errors->has('cv') ? ' is-invalid' : '' }}" id="cv" placeholder="{{ ($lang == 'ar') ? 'السيرة الذاتية' : 'CV' }}" name="cv" value="{{ old('cv')}}">
                                    @error('cv')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{--<div class="form-group row flex">--}}
                                {{--<label for="infection" class="col-sm-4 text-right control-label col-form-label">--}}
                                    {{--@if($lang == 'ar')--}}
                                    {{--تحليل العدوي--}}
                                    {{--@else--}}
                                    {{--Infection Analysis--}}
                                    {{--@endif--}}
                                {{--</label>--}}
                                {{--<div class="col-sm-8">--}}
                                    {{--<input type="file" class="form-control {{ $errors->has('infection') ? ' is-invalid' : '' }}" id="infection" placeholder="{{ ($lang == 'ar') ? 'العدوي' : 'Infection' }}" name="infection" value="{{ old('infection')}}">--}}
                                    {{--@error('infection')--}}
                                    {{--<span class="invalid-feedback">--}}
                                        {{--<strong>{{ $message }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@enderror--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group row flex">--}}
                                {{--<label for="criminal" class="col-sm-4 text-right control-label col-form-label">--}}
                                    {{--@if($lang == 'ar')--}}
                                    {{--الصحيفة الجنائية--}}
                                    {{--@else--}}
                                    {{--Criminal Status--}}
                                    {{--@endif--}}
                                {{--</label>--}}
                                {{--<div class="col-sm-8">--}}
                                    {{--<input type="file" class="form-control {{ $errors->has('criminal') ? ' is-invalid' : '' }}" id="criminal" placeholder="{{ ($lang == 'ar') ? ' الصحيفة الجنائية' : 'Criminal Status' }}" name="criminal" value="{{ old('criminal')}}">--}}
                                    {{--@error('criminal')--}}
                                    {{--<span class="invalid-feedback">--}}
                                        {{--<strong>{{ $message }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@enderror--}}
                                {{--</div>--}}
                            {{--</div>--}}

                        </div>
                        <div class="border-top">
                            <div class="card-body text-left">
                                <button type="submit" class="btn btn-default btn-download hvr-float-shadow">
                                    @if($lang == 'ar')
                                    ارسال الطلب
                                    @else
                                    Send Application
                                    @endif
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
        </div>
        <div class="overlay-light"></div>
    </section>
@endsection
