@extends('admin.layouts.app')
@section('title' , 'كل الاشتراكات')
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
                <h4 class="card-title text-white">كل الاشتراكات</h4>
            </div>
            <div class="comment-widgets">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead class="bg-cyan text-white">
                            <tr class="text-center">
                                <th>#</th>
                                <th>المشتركين</th>
                                <th>الباقة</th>
                                <th>سعر الباقة</th>
                                <th>عدد الوحدات</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subscriptions as $key => $one)
                            <tr class="text-center">
                                <td>{{ $key+1 }}</td>
                                <td><a href="{{ route('admin.users.edit' , [$one->user_id]) }}">{{ $one->user->name }}</a></td>
                                <td>{{ $one->package->translate('ar')->title }}</td>
                                <td>{{ $one->price }} {{ $settings->currency }}</td>
                                <td>{{ $one->units }}</td>
                                <td>
                                    <form action="{{route('admin.subscriptions.destroy' , [$one->id])}}" method="POST" class="d-inline-block">
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
