@extends('admin.layouts.app')
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
        buttons: [
                'print','csv','excel','copy'
            ],
        stateSave: true,
        dom : "Brfltip"
    });
    myFunc = (type) => {
        switch (type) {
            case ("active_incubators") :
            document.getElementById("active").style.display = ""; 
            document.getElementById("angels").style.display = "none"; 
            document.getElementById("blocked").style.display = "none"; 
            document.getElementById("children").style.display = "none"; 
            document.getElementById("incubators").style.display = "none"; 
            document.getElementById("contact").style.display = "none"; 
                document.getElementById("myHeads").innerHTML = `
                                <th>#</th>
                                <th>الاسم</th>
                                <th>الإيميل</th>
                                <th>الهاتف</th>
                                <th class="text-center">الحالة</th>
                                <th class="text-center">التحكم</th>
                                    `
                break;
        case ("incubators") :
            document.getElementById("active").style.display = "none"; 
            document.getElementById("angels").style.display = "none"; 
            document.getElementById("blocked").style.display = "none"; 
            document.getElementById("children").style.display = "none"; 
            document.getElementById("incubators").style.display = ""; 
            document.getElementById("contact").style.display = "none"; 
                document.getElementById("myHeads").innerHTML = `
                                <th>#</th>
                                <th>الاسم</th>
                                <th>الإيميل</th>
                                <th>الهاتف</th>
                                <th class="text-center">الحالة</th>
                                <th class="text-center">التحكم</th>
                                    `
                break;
            case ("blocked_incubators") :
                document.getElementById("blocked").style.display = ""; 
                document.getElementById("active").style.display = "none"; 
                document.getElementById("children").style.display = "none"; 
                document.getElementById("incubators").style.display = "none"; 
                document.getElementById("angels").style.display = "none"; 
                document.getElementById("contact").style.display = "none"; 
                    document.getElementById("myHeads").innerHTML = `
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>الإيميل</th>
                                    <th>الهاتف</th>
                                    <th class="text-center">الحالة</th>
                                    <th class="text-center">التحكم</th>
                                        `
                    break;
            case ("angels") :
                document.getElementById("blocked").style.display = "none"; 
                document.getElementById("active").style.display = "none"; 
                document.getElementById("angels").style.display = ""; 
                document.getElementById("children").style.display = "none"; 
                document.getElementById("incubators").style.display = "none"; 
                document.getElementById("contact").style.display = "none"; 
                    document.getElementById("myHeads").innerHTML = `
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>الإيميل</th>
                                    <th>الهاتف</th>
                                    <th class="text-center">الحالة</th>
                                    <th class="text-center">التحكم</th>
                                        `
                    break;
            case ("children"):
                document.getElementById("blocked").style.display = "none"; 
                document.getElementById("active").style.display = "none"; 
                document.getElementById("angels").style.display = "none"; 
                document.getElementById("children").style.display = ""; 
                document.getElementById("incubators").style.display = "none"; 
                document.getElementById("contact").style.display = "none"; 
                document.getElementById("myHeads").innerHTML = ` 
                                <th>#</th>
                                <th>الطفل</th>
                                <th>السنوات</th>
                                <th>الشهور</th>
                                <th>الأدوية</th>
                                <th>ملاحظات</th>
                                <th class="text-center">الحالة</th>`
                break;
                case ("contacts"):
                document.getElementById("blocked").style.display = "none"; 
                document.getElementById("active").style.display = "none"; 
                document.getElementById("angels").style.display = "none"; 
                document.getElementById("children").style.display = "none"; 
                document.getElementById("incubators").style.display = "none"; 
                document.getElementById("contact").style.display = ""; 
                document.getElementById("myHeads").innerHTML = ` 
                                <th>#</th>
                                <th>اسم المستخدم</th>
                                <th>الهاتف</th>
                                <th>النوع</th>
                                <th>الحالة</th>
                                <th>التحكم</th>
                            `
                break;

        }    
          
    }
</script>
@endsection

@section('content')
<div class="row">
    @forelse($tabs as $one)
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card card-hover">
            <a onclick="myFunc('{{$one['type']}}')" class="box {{$one['color']}} text-center d-block">
                <h1 class="font-light text-white"><i class="{{$one['icon']}}"></i></h1>
                <h6 class="text-white"><span class="text-white">{{$one['title']}} ( {{$one['count']}} )</span></h6>
            </a>
        </div>
    </div>
    @empty
    @endforelse
</div>

 {{-- THis is our table --}}
<div class="row">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body box bg-cyan ">
                
            </div>
            <div class="comment-widgets">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead class="bg-cyan text-white">
                            <tr class="text-center" id="myHeads">
                                <th>#</th>
                                <th>الاسم</th>
                                <th>الإيميل</th>
                                <th>الهاتف</th>
                                <th class="text-center">الحالة</th>
                                <th class="text-center">التحكم</th>
                            </tr>
                        </thead>

                        <tbody  id="angels" >
                            @forelse($angels as $onekey => $one)
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

                        <tbody style="display:none"  id="incubators" >
                            @forelse($incubators as $onekey => $one)
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

                        <tbody style="display: none" id="active" >
                            @forelse($active_incubators as $onekey => $one)
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
                        <tbody style="display: none" id="blocked" >
                            @forelse($blocked_incubators as $onekey => $one)
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
                        <tbody style="display: none" id="children" >
                            @forelse($children as $onekey => $one)
                                <tr class="text-center">
                                    <td>{{$onekey+1}}</td>
                                    <td>{{$one->title}}</td>
                                    <td>{{$one->years}}</td>
                                    <td>{{$one->months}}</td>
                                    <td>{!! $one->medicineTxt !!}</td>
                                    <td>{{$one->notes}}</td>
                                    <td class="text-center">{!! $one->isActiveTxt !!}</td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>

                        </tbody>
                        <tbody style="display: none" id="contact" >
                            @forelse($contacts as $key => $one)
                                <tr class="text-center">
                                    <td>{{$key+1}}</td>
                                    <td>
                                        @if(isset($one->user_id))
                                            <a href="{{url('admin/users/'.$one->user_id)}}">{{ $one->user->name }}
                                            </a>
                                        @else
                                            {{ $one->name }}
                                        @endif
                                    </td>
                                    <td>{{$one->phone}}</td>
                                    <td>{!! $one->typeTxt !!}</td>
                                    <td>{!! $one->isRepliedTxt !!}</td>
                                    <td>
                                        <a href="{{route('admin.contacts.edit' , [$one->id])}}" class="btn btn-cyan btn-sm"><i class="fas fa-edit"></i></a>
                                        <form action="{{route('admin.contacts.destroy' , [$one->id])}}" method="POST" class="d-inline-block">
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
