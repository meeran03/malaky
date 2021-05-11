@extends('admin.layouts.app')
@section('title' , 'إضافة دور')
@section('content')
    <form class="form-horizontal" method="POST" action="{{isset($role) ? route('admin.roles.update',[$role->id]) : route('admin.roles.store')}}">
        {!! isset($role) ? method_field('PATCH') : '' !!}
        @csrf
        <div class="row">
            <!-- column -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body box bg-cyan ">
                        <h4 class="card-title text-white">إضافة دور</h4>
                    </div>
                    <div class="comment-widgets">

                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 text-right control-label col-form-label"> اسم الدور  </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}  @if(isset($role) && $role->id ==1 ) disabled @endif" id="name" placeholder="اسم الدور " name="name" value="{{ isset($role) ? $role->name : old('name')}}">
                                    @error('name')
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
            @forelse($app_tables as $one)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body box bg-info ">
                            <h4 class="card-title text-white">{{$one->title}} <i class="mdi mdi-check-all check-all"></i></h4>

                        </div>
                        <div class="comment-widgets">
                            <div class="card-body">
                                @forelse( \Spatie\Permission\Models\Permission::where('name', 'LIKE', "{$one->title_en}%")->get() as $permission)
                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        <input name="permissions[]" type="checkbox" class="custom-control-input" id="{{$one->title_en . $permission->id}}" value="{{$permission->name}}" @if( isset($role) && $role->hasPermissionTo($permission->name) ) checked @endif >
                                        <label class="custom-control-label" for="{{$one->title_en . $permission->id}}">
                                            {{--{{$permission->name}}--}}
                                            @if (strpos($permission->name, 'create') == true) إنشاء {{$one->title}}
                                            @elseif (strpos($permission->name, 'read') == true)عرض {{$one->title}}
                                            @elseif (strpos($permission->name, 'update') == true) تحديث {{$one->title}}
                                            @elseif (strpos($permission->name, 'delete') == true) حذف {{$one->title}}  @endif
                                        </label>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
            <div class="col-lg-12">
                <div class="card">
                    <div class="comment-widgets">
                        <div class="border-top">
                            <div class="card-body text-left">
                                <button type="submit" class="btn btn-primary">تأكيد</button>
                                <button type="reset" class="btn btn-warning">إعادة</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        $('.check-all').on('click',function(){
            $(this).parents('.card').children().find('input[type=checkbox]').prop("checked", true);
        });
    </script>
@endsection
