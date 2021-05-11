@extends('admin.layouts.app')
@section('title' , 'الإعدادات')
@section('content')

<form class="form-horizontal" method="POST" action="{{route('admin.settings.store')}}" enctype="multipart/form-data">
    {!! isset($settings) ? method_field('POST') : '' !!}
    @csrf
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body box bg-info">
                    <h4 class="card-title text-white">الإعدادات العامة</h4>
                </div>

                <img src="{{isset($settings) ? $settings->imagePath : asset('images/settings/logo1.png')}}" style="width: 40%" class="mt-3 hai-img" alt="default logo">

                <div class="card-body">
                    @foreach(app_languages() as $key=>$one)
                    <div class="form-group row">
                        <label for="logo" class="col-sm-3 text-right control-label col-form-label">عنوان الموقع {{$one['title']}}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control {{ $errors->has($one['code'].'.title') ? ' is-invalid' : '' }}" name="{{$one['code']}}[title]" value="{{ isset($settings) ? $settings->translate($one['code'])->title : old($one['code'].'.title')}}" placeholder="عنوان الموقع {{$one['title']}}">
                            @error($one['code'].'.title')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="logo" class="col-sm-3 text-right control-label col-form-label">الوصف {{$one['title']}}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control {{ $errors->has($one['code'].'.description') ? ' is-invalid' : '' }}" name="{{$one['code']}}[description]" placeholder="وصف الموقع {{$one['title']}}">{{ isset($settings) ? $settings->translate($one['code'])->description : old($one['code'].'.description') }}</textarea>
                            @error($one['code'].'.description')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    @endforeach

                    <div class="form-group row">
                        <label for="logo" class="col-sm-3 text-right control-label col-form-label">الشعار</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control {{ $errors->has('logo') ? ' is-invalid' : '' }}" name="logo" value="{{ isset($settings) ? $settings->logo : old('logo')}}" id="logo">
                            @error('logo')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">حقوق النشر</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('copyrights') ? ' is-invalid' : '' }}" name="copyrights" value="{{ isset($settings) ? $settings->copyrights : old('copyrights')}}" placeholder="حقوق النشر">
                            @error('copyrights')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">العملة</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('currency') ? ' is-invalid' : '' }}" name="currency" value="{{ isset($settings) ? $settings->currency : old('currency')}}" placeholder="العملة">
                            @error('currency')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">العملة بالدولار</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('currency_dollar') ? ' is-invalid' : '' }}" name="currency_dollar" value="{{ isset($settings) ? $settings->currency_dollar : old('currency_dollar')}}" placeholder="العملة بالدولار">
                            @error('currency_dollar')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">الصيانة</label>
                        <input type="checkbox" class="mt-2" name="maintenance" value="{{ isset($settings) ? $settings->maintenance : old('maintenance') }}" @if($settings->maintenance == 1) ? checked : '' @endif>
                    </div>
                    @if( !empty(env("SMS_USERNAME")) &&  !empty(env("SMS_PASSWORD")) && !empty(env("SMS_TAGNAME")) )
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">رصيد الرسائل</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control disabled" value="{{$credit}}">
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>


        <div class="col-lg-6">
            <div class="card">
                <div class="card-body box bg-success">
                    <h4 class="card-title text-white">العناوين</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">العنوان</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ isset($settings) ? $settings->address : old('address')}}" placeholder="العنوان">
                            @error('address')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">الهاتف 1</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ isset($settings) ? $settings->phone : old('phone')}}" placeholder="الهاتف 1">
                            @error('phone')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">الهاتف 2</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control {{ $errors->has('phone2') ? ' is-invalid' : '' }}" name="phone2" value="{{ isset($settings) ? $settings->phone2 : old('phone2')}}" placeholder="الهاتف 2">
                            @error('phone2')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">الخريطة</label>
                        <div class="col-sm-9">
                            <textarea class="form-control {{ $errors->has('map') ? ' is-invalid' : '' }}" name="map">{{ isset($settings) ? $settings->map : old('map') }}</textarea>
                            @error('map')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body box bg-secondary">
                    <h4 class="card-title text-white">وسائل التواصل الاجتماعي</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">البريد الإلكتروني</label>
                        <div class="col-sm-9">
                            <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ isset($settings) ? $settings->email : old('email') }}" placeholder="البريد الإلكتروني">
                            @error('email')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">Facebook</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('facebook') ? ' is-invalid' : '' }}" name="facebook" value="{{ isset($settings) ? $settings->facebook : old('facebook') }}" placeholder="Facebook URL Here">
                            @error('facebook')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">Twitter</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('twitter') ? ' is-invalid' : '' }}" name="twitter" value="{{ isset($settings) ? $settings->twitter : old('twitter') }}" placeholder="Twitter URL Here">
                            @error('twitter')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">WhatsApp</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('whatsapp') ? ' is-invalid' : '' }}" name="whatsapp" value="{{ isset($settings) ? $settings->whatsapp : old('whatsapp') }}" placeholder="WhatsApp URL Here">
                        </div>
                        @error('whatsapp')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">Linked-in</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('linkedin') ? ' is-invalid' : '' }}" name="linkedin" value="{{ isset($settings) ? $settings->linkedin : old('linkedin') }}" placeholder="Linked-in URL Here">
                            @error('linkedin')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">Youtube</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('youtube') ? ' is-invalid' : '' }}" name="youtube" value="{{ isset($settings) ? $settings->youtube : old('youtube') }}" placeholder="Youtube URL Here">
                            @error('youtube')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">Snapchat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('snapchat') ? ' is-invalid' : '' }}" name="snapchat" value="{{ isset($settings) ? $settings->snapchat : old('snapchat') }}" placeholder="Snapchat URL Here">
                            @error('snapchat')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">Instagram</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('instagram') ? ' is-invalid' : '' }}" name="instagram" value="{{ isset($settings) ? $settings->instagram : old('instagram') }}" placeholder="Instagram URL Here">
                            @error('instagram')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-top">
            <div class="card-body text-left">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div>
        </div>
    </div>
</form>
@endsection
