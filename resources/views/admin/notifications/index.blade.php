@extends('admin.layouts.app')
@section('title' , 'كل الإشعارات')
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
                <h4 class="card-title text-white">كل الإشعارات</h4>
            </div>
            <div class="comment-widgets">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <div class="card-body">
                            @if(Auth::user()->unreadNotifications()->count())
                            <a href="{{ route('admin.markAllAsRead') }}" class="mr-2 btn btn-success btn-md float-left"> تحديد الكل كمقروء <i class="mdi mdi-check-all"></i></a>
                            @endif
                            @if(Auth::user()->notifications()->count())
                            <a href="{{ route('admin.destroyAll') }}" class="btn btn-danger btn-md float-left"> حذف الكل <i class="fas fa-trash"></i></a>
                            @endif
                        </div>
                        <thead class="bg-cyan text-white">
                            <tr class="text-center">
                                <th>#</th>
                                <th>العنوان</th>
                                <th>التاريخ</th>
                                <th>الحالة</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allNotifications as $key => $one)
                            <tr class="text-center">
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <a href="{{ route('admin.notifications.show' , [$one->id]) }}" class="m-b-0 font-medium p-0">{{ $one->data['ar'] }}</a>
                                </td>
                                <td>{{ $one->created_at->diffForHumans() }}</td>
                                <td>{!! ($one->read() == 1 ) ? '<span class="badge badge-pill badge-success"> مقروء </span>' : '<span class="badge badge-pill badge-warning"> غير مقروء </span>' !!}</td>
                                <td>
                                    @if($one->read() == 0)
                                    <form action="{{route('admin.notifications.update' , [$one->id])}}" method="POST" class="d-inline-block">
                                        @csrf
                                        {{method_field('PATCH')}}
                                        <input type="hidden" name="suspend" value="{{ ($one->read() == true ) ? null : now() }}">
                                        <button type="submit" class="btn btn-success btn-sm"> <i class="fas fa-eye"></i> </button>
                                    </form>
                                    @endif
                                    <form action="{{route('admin.notifications.destroy' , [$one->id])}}" method="POST" class="d-inline-block">
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
            </div>
        </div>
    </div>

</div>
@endsection
