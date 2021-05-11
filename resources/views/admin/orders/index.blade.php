@extends('admin.layouts.app')
@section('title' , 'الطلبات')
@section('scripts')
<script src="{{asset('adminpanel/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>   

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
        stateSave: true,
        buttons: [
            'print','csv','excel','copy'
        ],
        dom : "Brfltip"
    });
</script>
@endsection
@section('content')
<div class="row">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body box bg-cyan ">
                <h4 class="card-title text-white">كل الطلبات</h4>
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
        </div>
    </div>
</div>
@endsection
