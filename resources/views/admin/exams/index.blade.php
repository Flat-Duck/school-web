@extends('admin.layouts.app', ['page' => 'exams'])

@section('title', 'موعد اختبار')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">موعد اختبار</h3>

                <a class="pull-right btn btn-sm bg-purple " href="{{ route('admin.exams.create') }}">
                    إضافة موعد اختبار جديد
                </a>
            </div>
            <div class="box-body">
                <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>تاريخ اختبار</th>
                        <th>المادة</th>
                        <th>الفصل</th>
                        <th>العمليات</th>
                    </tr>
                </thead>   
                    <tbody>
                    @forelse ($exams as $k=> $exam)
                        <tr>
                            <td>{{ $k+1}}</td>
                            <td>{{ $exam->date }}</td>
                            <td>{{ $exam->subject->name }}</td>
                            <td>{{ $exam->grade->name. ' / ' .$exam->room->name}}</td>
                            <td>
                                <a href="{{ route('admin.exams.edit', ['exam' => $exam->id]) }}">
                                   <span class="btn btn-warning">   <i class="fa fa-pencil-square-o"></i></span>
                                </a>

                                <form action="{{ route('admin.exams.destroy', ['exam' => $exam->id]) }}"
                                    method="POST"
                                    class="inline pointer"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <a onclick="if (confirm('هل انت متأكد من حدف موعد اختبار?')) { this.parentNode.submit() }">
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
                {{ $exams->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
</div>
@endsection