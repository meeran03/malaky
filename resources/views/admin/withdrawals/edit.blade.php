@extends('admin.layouts.app')
@section('title' , 'بيانات التسويات')
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
            buttons: [
                {
                    extend: 'print',
                    text: 'Print current page',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    }
                }
            ],
            stateSave: true
        });
    </script>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body box bg-cyan ">
                <h4 class="card-title text-white">بيانات التسويات</h4>
            </div>
            <div class="comment-widgets">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="user" class="col-sm-3 text-right control-label col-form-label"> اسم الملاذ </label>
                        <div class="col-sm-9">
                            <h4><a href="{{ route('admin.users.edit' , [$user->id]) }}">{{ $user->name }}</a></h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="order_date" class="col-sm-3 text-right control-label col-form-label"> إجمالي التسويات </label>
                        <div class="col-sm-9">
                            <h4 id="order_date">{{ $user->withdrawals->where('is_active',0)->sum('amount')}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body box bg-success">
                <h4 class="card-title text-white">أخر تسوية</h4>
            </div>
            <div class="comment-widgets">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="order_date_from" class="col-sm-3 text-right control-label col-form-label"> من  </label>
                        <div class="col-sm-9">
                            <h4 id="order_date_from">{{ !empty($user->withdrawals->first()) ? $user->withdrawals->first()->start_date : 'لا يوجد'}}</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="order_date_to" class="col-sm-3 text-right control-label col-form-label"> إلى  </label>
                        <div class="col-sm-9">
                            <h4 id="order_date_to">{{ !empty($user->withdrawals->first()) ? $user->withdrawals->first()->end_date : 'لا يوجد'}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body box bg-info ">
                <h4 class="card-title text-white">كل التسويات</h4>
            </div>
            <div class="comment-widgets">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead class="bg-cyan text-white">
                        <tr class="text-center">
                            <th>#</th>
                            <th>الوحدات</th>
                            <th>من</th>
                            <th>إلى</th>
                            <th>الحالة</th>
                            <th>التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($user->withdrawals as $key => $one)
                            <tr class="text-center">
                                <td>{{$key+1}}</td>
                                <td><span class="badge badge-pill badge-orange">{{ $one->amount }}</span></td>
                                <td>{{ $one->start_date }}</td>
                                <td>{{ $one->end_date }}</td>
                                <td>{!! $one->isActiveTxt  !!} </td>
                                <td>
                                    <form class="d-inline-block" action="{{route('admin.withdrawals.store')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                                        <input type="hidden" name="start_date" value="{{ date($one->start_date)}}">
                                        <input type="hidden" name="end_date" value="{{ date($one->end_date )}}">
                                        <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if(!empty($user->withdrawals->where('is_active',0)))
                <form class="form-horizontal" method="POST" action="{{ route('admin.withdrawals.update',[$user->id]) }}">
                    @csrf
                    {{method_field('PATCH')}}
                    <div class="border-top">
                        <div class="card-body text-left">
                            <button type="submit" class="btn btn-primary">تصفية</button>
                            <button type="reset" class="btn btn-warning">إعادة</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
