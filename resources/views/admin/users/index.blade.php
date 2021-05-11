@extends('admin.layouts.app')
@section('title' , 'كل الأعضاء')
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
    </script>
@endsection
@section('content')
    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body box bg-cyan ">
                    <h4 class="card-title text-white">كل الأعضاء</h4>
                </div>
                <div class="accordion" id="accordionExample">
                    @forelse($types as $key => $type )
                        <div class="card m-b-0 border-top">
                            <div class="card-header" id="heading{{$key}}">
                                <h5 class="mb-0">
                                    <a class="@if($key !=0 ) collapsed @endif" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="@if($key ==0)true @else false @endif" aria-controls="collapse{{$key}}">
                                        <i class="m-r-5 fa fa-user-circle" aria-hidden="true"></i>
                                        <span>{{$type->title}}</span>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapse{{$key}}" class="collapse @if($key ==0)show @endif" aria-labelledby="heading{{$key}}" data-parent="#accordionExample">
                                <div class="card-body">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead class="bg-cyan text-white">
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>الإيميل</th>
                                            <th>الهاتف</th>
                                            <th class="text-center">الحالة</th>
                                            <th class="text-center">التحكم</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($type->users as $onekey => $one)
                                            <tr class="text-center">
                                                <td>{{$onekey+1}}</td>
                                                <td>{{$one->name}}</td>
                                                <td>{{$one->email}}</td>
                                                <td>{{$one->phone}}</td>
                                                <td class="text-center">{!! $one->isActiveTxt !!}</td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.users.edit' , [$one->id])}}" class="btn btn-cyan btn-sm"><i class="fas fa-edit"></i></a>
                                                    <form action="{{route('admin.users.update' , [$one->id])}}" method="POST" class="d-inline-block">
                                                        @csrf
                                                        {{method_field('PATCH')}}
                                                        <input type="hidden" name="suspend" value="{{ ($one->is_active == 1 ) ? 0 : 1 }}">
                                                        <button type="submit" class="btn btn-{{ ($one->is_active == 1 ) ? 'warning' : 'success' }} btn-sm"><i class="fas fa-{{ ($one->is_active == 1 ) ? 'times' : 'check' }}"></i></button>
                                                    </form>
                                                    <form action="{{route('admin.users.destroy' , [$one->id])}}" method="POST" class="d-inline-block">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                    </table>                        </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                <div class="border-top">
                    <div class="card-body text-left">
                        <a href="{{route('admin.users.create')}}" class="btn btn-info">إضافة عضو</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
