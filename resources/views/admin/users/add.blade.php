@extends('admin.layouts.app')
@section('title' , 'بيانات عضو')
@section('content')

<form class="form-horizontal" method="POST" action="{{isset($user) ? route('admin.users.update',[$user->id]) : route('admin.users.store')}}" enctype="multipart/form-data">
    {!! isset($user) ? method_field('PATCH') : '' !!}
    @csrf
    <div class="row">
        <!-- column -->
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body box bg-cyan ">
                    <h4 class="card-title text-white">بيانات عامة</h4>
                </div>
                <div class="comment-widgets">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 text-right control-label col-form-label"> @if (isset($user) && $user->type_id == 1) اسم ولي الأمر @elseif(isset($user) && $user->type_id == 2) اسم الملاذ @else اسم المالذ @endif</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" placeholder="اسم المالذ" name="name" value="{{ isset($user) ? $user->name : old('name')}}">
                                @error('name')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 text-right control-label col-form-label"> البريد الإلكتروني </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" placeholder="البريد الإلكتروني" name="email" value="{{ isset($user) ? $user->email : old('email')}}">
                                @error('email')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 text-right control-label col-form-label"> الهاتف </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="phone" placeholder="الهاتف" name="phone" value="{{ isset($user) ? $user->phone : old('phone')}}">
                                @error('phone')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="birthday" class="col-sm-3 text-right control-label col-form-label"> تاريخ الميلاد </label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control {{ $errors->has('birthday') ? ' is-invalid' : '' }}" id="birthday" placeholder="تاريخ الميلاد" name="birthday" value="{{ isset($user) ? $user->birthday : old('birthday')}}">
                                @error('birthday')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-sm-3 text-right control-label col-form-label">الجنس</label>
                            <div class="col-sm-9">
                                <select class="select2 form-control custom-select {{ $errors->has('gender') ? ' is-invalid' : '' }}" style="width: 100%; height:36px;" name="gender" id="gender">
                                    <option value="male" @if( (isset($user) && ($user->gender == 'male')) || (old('gender')== 'male')) selected @endif>ذكر</option>
                                    <option value="female" @if( (isset($user) && ($user->gender == 'female')) || (old('gender')== 'female')) selected @endif>أنثى</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type_id" class="col-sm-3 text-right control-label col-form-label">النوع</label>
                            <div class="col-sm-9">
                                <select class="select2 form-control custom-select {{ $errors->has('type_id') ? ' is-invalid' : '' }}" style="width: 100%; height:36px;" name="type_id" id="type_id">
                                    @forelse($types as $one)
                                    <option value="{{$one->id}}" @if( (isset($user) && ($user->type_id == $one->id)) || (old('type_id')== $one->id)) selected @endif>{{$one->translate('ar')->title}}</option>
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
                            <label for="bio" class="col-sm-3 text-right control-label col-form-label"> نبذة </label>
                            <div class="col-sm-9">
                                <textarea class="form-control {{ $errors->has('bio') ? ' is-invalid' : '' }}" id="bio" placeholder="نبذة" name="bio">{{ isset($user) ? $user->bio : old('bio')}}</textarea>
                                @error('bio')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row @if( isset($user) && $user->type_id >= 3) d-none @endif">
                            <label for="units" class="col-sm-3 text-right control-label col-form-label"> عدد الوحدات </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control {{ $errors->has('units') ? ' is-invalid' : '' }}" id="units" placeholder="عدد الوحدات" name="units" value="{{ isset($user) ? $user->units : old('units')}}">
                                @error('units')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 text-right control-label col-form-label"> كلمة المرور </label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" placeholder="كلمة المرور" name="password" value="">
                                @error('password')
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
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body box bg-info ">
                    <h4 class="card-title text-white">الصورة</h4>
                </div>
                <div class="comment-widgets">
                    <div class="card-body">
                        <img src="{{isset($user) ? $user->imagePath : asset('adminpanel/assets/images/user.jpg')}}" alt="user" class="hai-img">
                        <div class="form-group row">
                            @if(isset($user) && $user->image )
                            <input type="hidden" name="old_image" value="{{$user->image}}">
                            @endif
                            <div class="col-sm-12">
                                <input type="file" class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}" id="image" placeholder="الصورة" name="image" value="{{ isset($user) ? $user->image : old('image')}}">
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
            @if(admin_can_any('roles'))
            <div class="sec-permission @if( (isset($user) && $user->type_id != 3) || empty($user)) d-none @endif">
                <div class="card">
                    <div class="card-body box bg-danger ">
                        <h4 class="card-title text-white">الصلاحيات و الأدوار</h4>
                    </div>
                    <div class="comment-widgets">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="role_name" class="col-sm-3 text-right control-label col-form-label">الأدوار</label>
                                <div class="col-sm-9">
                                    <select class="select2 form-control custom-select {{ $errors->has('role_name') ? ' is-invalid' : '' }}" style="width: 100%; height:36px;" name="role_name" id="role_name">
                                        <option value="">إختر دور</option>
                                        @forelse($roles as $one)
                                        <option value="{{$one->name}}" @if( (isset($user) && ($user->hasRole($one->name) == $one->name)) || (old('role_name')== $one->name)) selected @endif>{{$one->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('role_name')
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
            @endif
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body box bg-warning ">
                    <h4 class="card-title text-white">بيانات العنوان</h4>
                </div>
                <div class="comment-widgets">
                    <div class="card-body">
                        @isset($user->ip)
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label"> أي بي </label>
                            <div class="col-sm-9">
                                {{$user->ip}}
                            </div>
                        </div>
                        @endisset
                        <div class="form-group row">
                            <label for="country_id" class="col-sm-3 text-right control-label col-form-label">الدولة</label>
                            <div class="col-sm-9">
                                <select class="select2 form-control custom-select {{ $errors->has('country_id') ? ' is-invalid' : '' }}" style="width: 100%; height:36px;" name="country_id" id="country_id">
                                    @forelse($countries as $one)
                                    <option value="{{$one->id}}" @if( (isset($user) && ($user->country_id == $one->id)) || (old('country_id')== $one->id)) selected @endif>{{$one->title_ar}}</option>
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
                            <label for="city_id" class="col-sm-3 text-right control-label col-form-label">المدينة</label>
                            <div class="col-sm-9">
                                <select class="select2 form-control custom-select {{ $errors->has('city_id') ? ' is-invalid' : '' }}" style="width: 100%; height:36px;" name="city_id" id="city_id">
                                    @forelse($cities as $one)
                                    <option value="{{$one->id}}" @if( (isset($user) && ($user->city_id == $one->id)) || (old('city_id')== $one->id)) selected @endif>{{$one->title_ar}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('city_id')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nationality_id" class="col-sm-3 text-right control-label col-form-label">الجنسية</label>
                            <div class="col-sm-9">
                                <select class="select2 form-control custom-select {{ $errors->has('nationality_id') ? ' is-invalid' : '' }}" style="width: 100%; height:36px;" name="nationality_id" id="nationality_id">
                                    @forelse($nationalities as $one)
                                    <option value="{{$one->id}}" @if( (isset($user) && ($user->nationality_id == $one->id)) || (old('nationality_id')== $one->id)) selected @endif>{{$one->title_ar}}</option>
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
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 text-right control-label col-form-label"> العنوان </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" id="address" placeholder="العنوان" name="address" value="{{ isset($user) ? $user->address : old('address')}}">
                                @error('address')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(isset($user) && $user->children->count() >0)
            <div class="card">
                <div class="card-body box bg-info ">
                    <h4 class="card-title text-white">الأطفال</h4>
                </div>
                    <div class="card-body">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead class="bg-info text-white">
                            <tr class="text-center">
                                <th>#</th>
                                <th>الطفل</th>
                                <th>السنوات</th>
                                <th>الشهور</th>
                                <th>الأدوية</th>
                                <th>ملاحظات</th>
                                <th class="text-center">الحالة</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($user->children as $onekey => $one)
                                <tr class="text-center">
                                    <td>{{$onekey+1}}</td>
                                    <td>{{$one->title}}</td>
                                    <td>{{$one->years}}</td>
                                    <td>{{$one->months}}</td>
                                    <td>{!! $one->medicineTxt !!}</td>
                                    <td>{{$one->notes}}</td>
                                    <td class="text-center">{!! $one->isActiveTxt !!}</td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>
            </div>
            @endif
        </div>
    </div>
    <div class="border-top">
        <div class="card-body text-left">
            <button type="submit" class="btn btn-primary">تأكيد</button>
            <button type="reset" class="btn btn-warning">إعادة</button>
        </div>
    </div>
</form>
@endsection
@section('scripts')
<script>
    $('#type_id').on('change', function() {
        if ($(this).val() == 3) {
            alert('أختر نوع الصلاحية');
            $('.sec-permission ').removeClass('d-none');
        } else {
            $('.sec-permission ').addClass('d-none');
        }
    })
</script>
@endsection
