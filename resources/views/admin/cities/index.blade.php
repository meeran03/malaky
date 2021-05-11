@extends('admin.layouts.app')
@section('title' , 'كل المدن')
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
                <h4 class="card-title text-white">كل المدن</h4>
            </div>
            <div class="comment-widgets">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead class="bg-cyan text-white">
                            <tr class="text-center">
                                <th>#</th>
                                <th>المدينة</th>
                                <th>المدينة بالإنجليزية</th>
                                <th>الدولة</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cities as $key => $one)
                            <tr class="text-center">
                                <td>{{$key+1}}</td>
                                <td>{{$one->title_ar}}</td>
                                <td>{{$one->title_en}}</td>
                                <td>{{$one->country->title_ar}}</td>
                                <td>
                                    <a href="{{route('admin.cities.edit' , [$one->id])}}" class="btn btn-cyan btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{route('admin.cities.destroy' , [$one->id])}}" method="POST" class="d-inline-block">
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
                        <a href="{{route('admin.cities.create')}}" class="btn btn-info">إضافة مدينة</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
