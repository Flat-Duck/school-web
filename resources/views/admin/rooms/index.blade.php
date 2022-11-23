@extends('admin.layouts.app', ['page' => 'rooms'])

@section('title', 'الفصل')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">الفصل</h3>

                <a class="pull-right btn btn-sm btn-success" href="{{ route('admin.rooms.create') }}">
                    إضافة فصل جديد
                </a>
            </div>
            <div class="box-body">
                <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> الفصل</th>
                        <th>اسم الصف</th>
                        <th>العمليات</th>
                    </tr>
                </thead>   
                    <tbody>
                    @forelse ($rooms as $k=> $room)
                        <tr>
                            <td>{{ $k+1}}</td>
                            <td>{{ $room->name }}</td>
                            <td>{{ $room->grade_id }}</td>
                            <td>
                                <a href="{{ route('admin.rooms.edit', ['room' => $room->id]) }}">
                                   <span class="btn btn-warning">   <i class="fa fa-pencil-square-o"></i></span>
                                </a>

                                <form action="{{ route('admin.rooms.destroy', ['room' => $room->id]) }}"
                                    method="POST"
                                    class="inline pointer"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <a onclick="if (confirm('هل انت متأكد من حدف الفصل?')) { this.parentNode.submit() }">
                                       <span class="btn btn-danger">    <i class="fa fa-trash-o"></i></span>
                                    </a>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">لا توجد سجلات</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>

            <div class="box-footer clearfix">
                {{ $rooms->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
</div>
@endsection