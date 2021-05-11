@extends('admin.layouts.app')
@section('title' , 'كل التقييمات')
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
                <h4 class="card-title text-white">كل التقييمات</h4>
            </div>
            <div class="comment-widgets">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">

                        <div class="card-body">
                            <h3>متوسط التقييمات :
                                @foreach(range(1,5) as $i)
                                <span class="fa-stack" style="width:1em;color:gold">
                                    <i class="far fa-star fa-stack-1x"></i>

                                    @if($rateAverage >0)
                                    @if($rateAverage > 0.5)
                                    <i class="fas fa-star fa-stack-1x"></i>
                                    @else
                                    <i class="fas fa-star-half fa-stack-1x"></i>
                                    @endif
                                    @endif

                                    @php $rateAverage--; @endphp
                                </span>
                                @endforeach
                            </h3>
                        </div>
                        <thead class="bg-cyan text-white">
                            <tr class="text-center">
                                <th>#</th>
                                <th>المستخدم</th>
                                <th>التقييم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($apprates as $key => $one)
                            <tr class="text-center">
                                <td>{{$key+1}}</td>
                                <td><a href="{{ route('admin.users.edit' , [$one->user_id]) }}">{{ $one->user->name }}</a></td>
                                <td>
                                    @foreach(range(1,5) as $i)
                                    <span class="fa-stack" style="width:2em;color:gold">
                                        <i class="far fa-star fa-stack-2x"></i>

                                        @if($one->value >0)
                                        @if($one->value > 0.5)
                                        <i class="fas fa-star fa-stack-2x"></i>
                                        @else
                                        <i class="fas fa-star-half fa-stack-2x"></i>
                                        @endif
                                        @endif

                                        @php $one->value--; @endphp
                                    </span>
                                    @endforeach
                                </td>
                                @empty
                                @endforelse
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection