@extends('admin.layouts.app', ['page' => 'time_tables'])

@section('title', 'جدول دراسي')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">جدول دراسي</h3>

                <a class="pull-right btn btn-sm btn-success" href="{{ route('admin.time_tables.create') }}">
                    إضافة جدول دراسي جديد
                </a>
            </div>
            <div class="box-body">
                <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الفصل</th>
                        <th>العمليات</th>
                    </tr>
                </thead>   
                    <tbody>
                    @forelse ($time_tables as $k=> $time_table)
                        <tr>
                            <td>{{ $k+1}}</td>
                            <td>{{ $time_table->grade->name. ' / ' .$time_table->room->name}}</td>                            
                            <td>
                                <a href="{{ route('admin.time_tables.show', ['time_table' => $time_table->id]) }}">
                                    <span class="btn btn-info">   <i class="fa fa-eye"></i></span>
                                 </a>

                                <a href="{{ route('admin.time_tables.edit', ['time_table' => $time_table->id]) }}">
                                   <span class="btn btn-warning">   <i class="fa fa-pencil-square-o"></i></span>
                                </a>

                                <form action="{{ route('admin.time_tables.destroy', ['time_table' => $time_table->id]) }}"
                                    method="POST"
                                    class="inline pointer"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <a onclick="if (confirm('هل انت متأكد من حدف جدول دراسي?')) { this.parentNode.submit() }">
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
                {{ $time_tables->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
</div>
@endsection