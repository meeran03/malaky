@extends('admin.layouts.app')
@section('title' , 'إضافة صفحة')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    هناك خطأ ، يرجى مراجعة البيانات المدرجة
</div>
@endif

<form class="form-horizontal" method="POST" action="{{ isset($page) ? route('admin.pages.update',[$page->id]) : route('admin.pages.store') }}" enctype="multipart/form-data">
    {!! isset($page) ? method_field('PATCH') : '' !!}
    @csrf
    <div class="row">
        <!-- data column -->

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body box bg-cyan ">
                    <h4 class="card-title text-white">بيانات الصفحة</h4>
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
                                <label for="title-{{ $one['code'] }}" class="col-sm-3 text-right control-label col-form-label"> اسم الصفحة {{$one['title']}} </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{ $errors->has($one['code'].'.title') ? ' is-invalid' : '' }}" id="title-{{ $one['code'] }}" placeholder="اسم الصفحة  {{$one['title']}}" name="{{$one['code']}}[title]" value="{{ isset($page) ? $page->translate($one['code'])->title : old($one['code'].'.title') }}">
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
                                    <input type="text" class="form-control {{ $errors->has($one['code'].'.excerpt') ? ' is-invalid' : '' }}" id="excerpt-{{ $one['code'] }}" placeholder="المقتطف {{ $one['title'] }}" name="{{$one['code']}}[excerpt]" value="{{ isset($page) ? $page->translate($one['code'])->excerpt : old($one['code'].'.excerpt') }}">
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
                                    <textarea class="form-control {{ $errors->has($one['code'].'.content') ? ' is-invalid' : '' }}" id="content-{{ $one['code'] }}" placeholder="المحتوى {{ $one['title'] }}" name="{{$one['code']}}[content]">{{ isset($page) ? $page->translate($one['code'])->content : old($one['code'].'.content') }}</textarea>
                                    @error($one['code'].'.content')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- image column -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body box bg-info ">
                    <h4 class="card-title text-white">الصورة</h4>
                </div>
                <div class="comment-widgets">
                    <div class="card-body">
                        <img src="{{isset($page) ? $page->imagePath : asset('adminpanel/assets/images/default1.jpg')}}" alt="page image" class="hai-img">
                        <div class="form-group row">
                            @if(isset($page) && $page->image )
                            <input type="hidden" name="old_image" value="{{$page->image}}">
                            @endif
                            <div class="col-sm-12">
                                <input type="file" class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}" id="image" placeholder="الصورة" name="image" value="{{ isset($page) ? $page->image : old('image')}}">
                                @error('image')
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
    // var quill = new Quill('#content-ar', {
    //     theme: 'snow',
    // });
    // var quill = new Quill('#content-en', {
    //     theme: 'snow'
    // });
    $(document).ready(function() {
        $('#content-ar').summernote();
        $('#content-en').summernote();
    });
</script>
@endsection
