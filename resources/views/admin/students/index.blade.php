@extends('admin.layouts.app', ['page' => 'students'])

@section('title', 'إدارة الطلبة')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">إدارة الطلبة</h3>

                <a class="pull-right btn btn-sm btn-success" href="{{ route('admin.students.create') }}">
                    إضافة طالب جديد
                </a>
            </div>
            <div class="box-body">
                <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>الصف /الفصل</th>
                        <th>تاريخ الميلاد</th>
                        <th>الجنس</th>
                        <th>هاتف ولي الامر</th>
                        <th>العمليات</th>
                    </tr>
                </thead>   
                    <tbody>
                    @forelse ($students as $k=> $student)
                        <tr>
                            <td>{{ $k+1}}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->grade->name.' / '.$student->room->name}}</td>
                            <td>{{ $student->birth_date }}</td>                            
                            <td>{{ $student->gender }}</td>                            
                            <td>{{ $student->phone }}</td>                            
                            <td>
                                <a href="{{ route('admin.students.edit', ['student' => $student->id]) }}">
                                   <span class="btn btn-warning">   <i class="fa fa-pencil-square-o"></i></span>
                                </a>

                                <form action="{{ route('admin.students.destroy', ['student' => $student->id]) }}"
                                    method="POST"
                                    class="inline pointer"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <a onclick="if (confirm('هل انت متأكد من حدف الطالب?')) { this.parentNode.submit() }">
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
                {{ $students->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
</div>
@endsection