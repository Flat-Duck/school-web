@extends('admin.layouts.app', ['page' => 'notes'])

@section('title', 'الملاحضات')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">الملاحضات</h3>

                <a class="pull-right btn btn-sm bg-purple " href="{{ route('admin.notes.create') }}">
                    إضافة ملاحظة جديد
                </a>
            </div>
            <div class="box-body">
                <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الملاحضة</th>
                        <th>اسم الطالب</th>
                        <th>العمليات</th>
                    </tr>
                </thead>   
                    <tbody>
                    @forelse ($notes as $k=> $note)
                        <tr>
                            <td>{{ $k+1}}</td>
                            <td>{{ $note->content }}</td>
                            <td>{{ $note->student->name }}</td>
                            <td>
                                <a href="{{ route('admin.notes.edit', ['note' => $note->id]) }}">
                                   <span class="btn btn-warning">   <i class="fa fa-pencil-square-o"></i></span>
                                </a>

                                <form action="{{ route('admin.notes.destroy', ['note' => $note->id]) }}"
                                    method="POST"
                                    class="inline pointer"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <a onclick="if (confirm('هل انت متأكد من حدف الملاحظة?')) { this.parentNode.submit() }">
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
                {{ $notes->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
</div>
@endsection