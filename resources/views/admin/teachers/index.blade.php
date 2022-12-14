@extends('admin.layouts.app', ['page' => 'teachers'])

@section('title', 'إدارة المعلمين')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">إدارة المعلمين</h3>

                <a class="pull-right btn btn-sm bg-purple " href="{{ route('admin.teachers.create') }}">
                    إضافة معلم جديد
                </a>
            </div>
            <div class="box-body">
                <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>                    
                        <th>الجنس</th>                    
                        <th>رقم الهاتف</th>                    
                        <th>العمليات</th>
                    </tr>
                </thead>   
                    <tbody>
                    @forelse ($teachers as $k=> $teacher)
                        <tr>
                            <td>{{ $k+1}}</td>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->gender }}</td>
                            <td>{{ $teacher->phone }}</td>
                            <td>
                                <a href="{{ route('admin.teachers.edit', ['teacher' => $teacher->id]) }}">
                                   <span class="btn btn-warning">   <i class="fa fa-pencil-square-o"></i></span>
                                </a>

                                <form action="{{ route('admin.teachers.destroy', ['teacher' => $teacher->id]) }}"
                                    method="POST"
                                    class="inline pointer"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <a onclick="if (confirm('هل انت متأكد من حدف المعلم?')) { this.parentNode.submit() }">
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
                {{ $teachers->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
</div>
@endsection