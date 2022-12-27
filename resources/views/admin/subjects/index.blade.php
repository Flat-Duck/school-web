@extends('admin.layouts.app', ['page' => 'subjects'])

@section('title', 'المواد الدراسية')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">المواد الدراسية</h3>

                <a class="pull-right btn btn-sm bg-purple " href="{{ route('admin.subjects.create') }}">
                    إضافة مادة جديدة
                </a>
            </div>
            <div class="box-body">
                <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم المادة</th>
                        <th>العمليات</th>
                    </tr>
                </thead>   
                    <tbody>
                    @forelse ($subjects as $k=> $subject)
                        <tr>
                            <td>{{ $k+1}}</td>
                            <td>{{ $subject->name }}</td>
                            
                            <td>
                                <a href="{{ route('admin.subjects.edit', ['subject' => $subject->id]) }}">
                                   <span class="btn btn-warning">   <i class="fa fa-pencil-square-o"></i></span>
                                </a>

                                <form action="{{ route('admin.subjects.destroy', ['subject' => $subject->id]) }}"
                                    method="POST"
                                    class="inline pointer"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <a onclick="if (confirm('هل انت متأكد من حدف المادة?')) { this.parentNode.submit() }">
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
                {{ $subjects->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
</div>
@endsection