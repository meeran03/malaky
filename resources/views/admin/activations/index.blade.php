@extends('admin.layouts.app')
@section('title' , 'كل مستخدمي الكوبونات')
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
                <h4 class="card-title text-white">كل مستخدمي الكوبونات</h4>
            </div>
            <div class="comment-widgets">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead class="bg-cyan text-white">
                            <tr class="text-center">
                                <th>#</th>
                                <th>اسم المستخدم</th>
                                <th>الكوبون</th>
                                <th>عدد الوحدات</th>
                                <th>تاريخ الاستخدام</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activations as $key => $one)
                            <tr class="text-center">
                                <td>{{$key+1}}</td>
                                <td><a href="{{ route('admin.users.edit' , [$one->user_id]) }}">{{ $one->user->name }}</a></td>
                                <td><a href="{{ route('admin.coupons.edit' , [$one->coupon_id]) }}">{{ $one->coupon->title }}</a></td>
                                <td>{{$one->coupon->units}}</td>
                                <td>{{$one->created_at->format('Y-m-d')}}</td>
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