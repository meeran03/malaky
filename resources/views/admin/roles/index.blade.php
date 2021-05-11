@extends('admin.layouts.app')
@section('title' , 'كل الأدوار')
@section('scripts')
<script src="{{asset('adminpanel/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
<script>
    $('.table').DataTable({
        "language": {
            "paginate": {
                "previous": "السابق",
                "next": "التالي",
                "search": "البحث:"
            }
        },
        "oLanguage": {
            "sSearch": "<span>البحث:</span> _INPUT_",
        },
        stateSave: true
    });
</script>
@endsection
@section('content')
<div class="row">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body box bg-cyan ">
                <h4 class="card-title text-white">كل الأدوار</h4>
            </div>
            <div class="comment-widgets">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead class="bg-cyan text-white">
                            <tr class="text-center">
                                <th>#</th>
                                <th>الدور</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $key => $one)
                            <tr class="text-center">
                                <td>{{$key+1}}</td>
                                <td>{{$one->name}}</td>
                                <td>
                                    <a href="{{route('admin.roles.edit' , [$one->id])}}" class="btn btn-cyan btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{route('admin.roles.destroy' , [$one->id])}}" method="POST" class="d-inline-block">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="border-top">
                    <div class="card-body text-left">
                        <a href="{{route('admin.roles.create')}}" class="btn btn-info">إضافة دور</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body box bg-info ">
                <h4 class="card-title text-white">كل الإدارة</h4>
            </div>
            <div class="accordion" id="accordionExample">
                @forelse($roles as $keyrole => $role)
                <div class="card m-b-0 @if($keyrole>0) border-top @endif">
                    <div class="card-header" id="heading{{$keyrole}}">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" data-target="#collapse{{$keyrole}}" aria-expanded="@if($keyrole == 0) true @else false @endif " aria-controls="collapse{{$keyrole}}" class="">
                                <i class="m-r-5 fa fa-user-circle" aria-hidden="true"></i>
                                <span>{{$role->name}}</span>
                            </a>
                        </h5>
                    </div>
                    <div id="collapse{{$keyrole}}" class="collapse @if($keyrole == 0) show @endif" aria-labelledby="heading{{$keyrole}}" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead class="bg-info text-white">
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>الإيميل</th>
                                        <th>الهاتف</th>
                                        <th class="text-center">الحالة</th>
                                        <th class="text-center">التحكم</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($role->users as $key => $one)
                                        @if($one->id != 1)
                                        <tr class="text-center">
                                            <td>{{$key+1}}</td>
                                            <td>{{$one->name}}</td>
                                            <td>{{$one->email}}</td>
                                            <td>{{$one->phone}}</td>
                                            <td class="text-center">{!! $one->isActiveTxt !!}</td>
                                            <td class="text-center">
                                                <a href="{{route('admin.users.edit' , [$one->id])}}" class="btn btn-cyan btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="{{route('admin.users.update' , [$one->id])}}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    {{method_field('PATCH')}}
                                                    <input type="hidden" name="suspend" value="{{ ($one->is_active == 1 ) ? 0 : 1 }}">
                                                    <button type="submit" class="btn btn-{{ ($one->is_active == 1 ) ? 'warning' : 'success' }} btn-sm"><i class="fas fa-{{ ($one->is_active == 1 ) ? 'times' : 'check' }}"></i></button>
                                                </form>
                                                <form action="{{route('admin.users.destroy' , [$one->id])}}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    {{method_field('DELETE')}}
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endif
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
