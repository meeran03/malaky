@extends('admin.layouts.app')
@section('title' , 'التسويات')
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
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body box bg-cyan ">
                <h4 class="card-title text-white">كل التسويات</h4>
            </div>
            <div class="comment-widgets">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead class="bg-cyan text-white">
                            <tr class="text-center">
                                <th>#</th>
                                <th>الملاذ</th>
                                <th>إجمالي الوحدات</th>
                                <th>تاريخ اخر تسوية</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $key => $one)
                            <tr class="text-center">
                                <td>{{$key+1}}</td>
                                <td><a href="{{ route('admin.users.edit' , [$one->id]) }}">{{ $one->name }}</a></td>
                                <td><span class="badge badge-pill badge-orange">{{ $one->withdrawals->where('is_active',0)->sum('amount')}}</span></td>
                                <td>{{ !empty($one->withdrawals->first()) ? $one->withdrawals->first()->end_date : 'لا يوجد' }}</td>
                                <td>
                                    <a href="{{route('admin.withdrawals.show' , [$one->id])}}" class="btn btn-cyan btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="{{route('admin.withdrawals.edit' , [$one->id])}}" class="btn btn-warning btn-sm"><i class="fas fa-donate"></i></a>
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
