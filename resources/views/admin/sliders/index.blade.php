@extends('admin.layouts.app')
@section('title' , 'كل السلايدرات')
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
                <h4 class="card-title text-white">كل السلايدرات</h4>
            </div>
            <div class="comment-widgets">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead class="bg-cyan text-white">
                            <tr class="text-center">
                                <th>#</th>
                                <th>السلايدر</th>
                                <th>تاريخ الإنشاء</th>
                                <th>الحالة</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sliders as $key => $one)
                            <tr class="text-center">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $one->title }}</td>
                                <td>{{ $one->created_at->format('Y-m-d') }}</td>
                                <td>{!! $one->isActiveTxt !!}</td>
                                <td>
                                    <a href="{{route('admin.sliders.edit' , [$one->id])}}" class="btn btn-cyan btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{route('admin.sliders.update' , [$one->id])}}" method="POST" class="d-inline-block">
                                        @csrf
                                        {{method_field('PATCH')}}
                                        <input type="hidden" name="suspend" value="{{ ($one->is_active == 1 ) ? 0 : 1 }}">
                                        <button type="submit" class="btn btn-{{ ($one->is_active == 1 ) ? 'warning' : 'success' }} btn-sm"><i class="fas fa-{{ ($one->is_active == 1 ) ? 'times' : 'check' }}"></i></button>
                                    </form>
                                    <form action="{{route('admin.sliders.destroy' , [$one->id])}}" method="POST" class="d-inline-block">
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
                        <a href="{{route('admin.sliders.create')}}" class="btn btn-info">إضافة سلايدر</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
