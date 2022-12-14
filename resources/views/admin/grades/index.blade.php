@extends('admin.layouts.app', ['page' => 'grades'])

@section('title', 'الصفوف الدراسية')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">الصفوف الدراسية</h3>

                <a class="pull-right btn btn-sm bg-purple " href="{{ route('admin.grades.create') }}">
                    إضافة صف جديدة
                </a>
            </div>
            <div class="box-body">
                <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم الصف</th>
                        <th>العمليات</th>
                    </tr>
                </thead>   
                    <tbody>
                    @forelse ($grades as $k=> $grade)
                        <tr>
                            <td>{{ $k+1}}</td>
                            <td>{{ $grade->name }}</td>
                            
                            <td>
                                <a href="{{ route('admin.grades.edit', ['grade' => $grade->id]) }}">
                                   <span class="btn btn-warning">   <i class="fa fa-pencil-square-o"></i></span>
                                </a>

                                <form action="{{ route('admin.grades.destroy', ['grade' => $grade->id]) }}"
                                    method="POST"
                                    class="inline pointer"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <a onclick="if (confirm('هل انت متأكد من حدف الصف?')) { this.parentNode.submit() }">
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
                {{ $grades->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
</div>
@endsection