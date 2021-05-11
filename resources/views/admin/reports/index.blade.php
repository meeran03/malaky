@extends('admin.layouts.app')
@section('title' , 'التقارير')
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
            <div class="card-body box bg-info ">
                <h4 class="card-title text-white">تحديد الفترة</h4>
            </div>
            <div class="comment-widgets">
                <form class="form-horizontal" action="{{route('admin.reports.search')}}" method="POST">
                    @csrf
                    <div class="card-body row">
                        <div class="form-group row col-md-6">
                            <label for="start_date" class="col-sm-3 text-right control-label col-form-label"> من </label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control {{ $errors->has('start_date') ? ' is-invalid' : '' }}" id="start_date" placeholder="من" name="start_date" value="{{ isset($start_date) ? optional($start_date)->format('Y-m-d') : old('start_date')}}">
                                @error('start_date')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="end_date" class="col-sm-3 text-right control-label col-form-label"> إلى </label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control {{ $errors->has('end_date') ? ' is-invalid' : '' }}" id="end_date" placeholder="إلى" name="end_date" value="{{ isset($end_date) ? optional($end_date)->format('Y-m-d') : old('end_date')}}">
                                @error('end_date')
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
        <div class="card">
            <div class="card-body box bg-cyan ">
                <h4 class="card-title text-white">كل التقارير</h4>
            </div>
            <div class="comment-widgets">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead class="bg-cyan text-white">
                            <tr class="text-center">
                                <th>#</th>
                                <th>الملاك</th>
                                <th>الملاذ</th>
                                <th>حالة الطلب</th>
                                <th>عدد الوحدات</th>
                                <th>التاريخ</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $key => $one)
                            <tr class="text-center">
                                <td>{{$key+1}}</td>
                                <td><a href="{{ route('admin.users.edit' , [$one->user_id]) }}">{{ $one->user->name }}</a></td>
                                <td><a href="{{ route('admin.users.edit' , [$one->receiver_id]) }}">{{ $one->receiver->name }}</a></td>
                                <td><span class="badge badge-pill badge-{{$one->statusTxt}}">{{$one->status->title}}</span></td>
                                <td>{{$one->units}}</td>
                                <td>{{ isset($one->date) ? $one->date->format('Y-m-d') : 'لا يوجد' }}</td>
                                <td>
                                    <a href="{{route('admin.orders.edit' , [$one->id])}}" class="btn btn-cyan btn-sm"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer box bg-dark text-center ">
                <h4 class="card-title text-white">الإجمالي : {{$total}}</h4>
            </div>
        </div>
    </div>
</div>
@endsection
