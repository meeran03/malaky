@extends('admin.layouts.app')
@section('title' , 'إضافة سلايدر')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    هناك خطأ ، يرجى مراجعة البيانات المدرجة
</div>
@endif

<form class="form-horizontal" method="POST" action="{{ isset($slider) ? route('admin.sliders.update',[$slider->id]) : route('admin.sliders.store') }}" enctype="multipart/form-data">
    {!! isset($slider) ? method_field('PATCH') : '' !!}
    @csrf
    <div class="row">
        <!-- data column -->

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body box bg-cyan ">
                    <h4 class="card-title text-white">بيانات السلايدر</h4>
                </div>
                <ul class="nav nav-tabs" role="tablist">
                    @foreach(app_languages() as $key=>$one)
                    <li class="nav-item"> <a class="nav-link @if($key == 0 ) active @endif" data-toggle="tab" href="#tab-{{$one['code']}}" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">{{ $one['title'] }}</span></a> </li>
                    @endforeach
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabcontent-border">
                    @foreach(app_languages() as $key=>$one)
                    <div class="tab-pane @if($key == 0 ) active @endif" id="tab-{{$one['code']}}" role="tabpanel">

                        <div class="card-body">
                            <div class="form-group row">
                                <label for="title-{{ $one['code'] }}" class="col-sm-3 text-right control-label col-form-label"> اسم السلايدر {{$one['title']}} </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{ $errors->has($one['code'].'.title') ? ' is-invalid' : '' }}" id="title-{{ $one['code'] }}" placeholder="اسم السلايدر  {{$one['title']}}" name="{{$one['code']}}[title]" value="{{ isset($slider) ? $slider->translate($one['code'])->title : old($one['code'].'.title') }}">
                                    @error($one['code'].'.title')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="excerpt-{{ $one['code'] }}" class="col-sm-3 text-right control-label col-form-label"> المقتطف {{ $one['title'] }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{ $errors->has($one['code'].'.excerpt') ? ' is-invalid' : '' }}" id="excerpt-{{ $one['code'] }}" placeholder="المقتطف {{ $one['title'] }}" name="{{$one['code']}}[excerpt]" value="{{ isset($slider) ? $slider->translate($one['code'])->excerpt : old($one['code'].'.excerpt') }}">
                                    @error($one['code'].'.excerpt')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="content-{{ $one['code'] }}" class="col-sm-3 text-right control-label col-form-label"> المحتوى {{ $one['title'] }}</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control {{ $errors->has($one['code'].'.content') ? ' is-invalid' : '' }}" id="content-{{ $one['code'] }}" placeholder="المحتوى {{ $one['title'] }}" name="{{$one['code']}}[content]">{{ isset($slider) ? $slider->translate($one['code'])->content : old($one['code'].'.content') }}</textarea>
                                    @error($one['code'].'.content')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image-{{ $one['code'] }}" class="col-sm-3 text-right control-label col-form-label"> الصور {{ $one['title'] }}</label>
                                <div class="col-sm-9">
                                    @isset($slider)
                                    @php( $image = explode(';', $slider->trans($one['code'])->image) )
                                    @endisset
                                    <img src="{{isset($slider) && isset($image) ? asset($image[0]) : asset('adminpanel/assets/images/default1.jpg')}}" alt="slider$slider image" class="hai-img">
                                    <div class="form-group row">

                                        @if(isset($slider) && $image)
                                        <input type="hidden" name="{{$one['code']}}[old_images]" value="{{$slider->trans($one['code'])->image}}">
                                        @endif
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control {{ $errors->has($one['code'].'.image') ? ' is-invalid' : '' }}" id="image-{{ $one['code'] }}" placeholder="الصورة" name="{{$one['code']}}[image][]" value="{{ isset($slider) ? $slider->image : old('image')}}" multiple>
                                            @error($one['code'].'.image')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if( isset($slider) && isset($image) && count($image) > 1)
                                    <div class="form-group row">
                                        @foreach($image as $key => $one)
                                        @if($key >0 )
                                        <img src="{{asset($one)}}" alt="slider image" class="hai-img">
                                        @endif
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <br>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="card-body text-left">
        <button type="submit" class="btn btn-primary">تأكيد</button>
        <button type="reset" class="btn btn-warning">إعادة</button>
    </div>
</form>
@endsection
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#content-ar').summernote({
            height: 100,
        });
        $('#content-en').summernote({
            height: 100,
        });
    });
</script>
@endsection