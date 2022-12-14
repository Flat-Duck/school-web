@extends('admin.layouts.app', ['page' => 'attendances'])

@section('title', 'الغياب')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">الغياب</h3>

                <a class="pull-right btn btn-sm bg-purple " href="{{ route('admin.attendances.create') }}">
                    إضافة غياب جديد
                </a>
            </div>
            <div class="box-body">
                <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>تاريخ الغياب</th>
                        <th>اسم الطالب</th>
                        <th>العمليات</th>
                    </tr>
                </thead>   
                    <tbody>
                    @forelse ($attendances as $k=> $attendance)
                        <tr>
                            <td>{{ $k+1}}</td>
                            <td>{{ $attendance->day }}</td>
                            <td>{{ $attendance->student->name }}</td>
                            <td>
                                <a href="{{ route('admin.attendances.edit', ['attendance' => $attendance->id]) }}">
                                   <span class="btn btn-warning">   <i class="fa fa-pencil-square-o"></i></span>
                                </a>

                                <form action="{{ route('admin.attendances.destroy', ['attendance' => $attendance->id]) }}"
                                    method="POST"
                                    class="inline pointer"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <a onclick="if (confirm('هل انت متأكد من حدف الغياب?')) { this.parentNode.submit() }">
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
                {{ $attendances->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
</div>
@endsection