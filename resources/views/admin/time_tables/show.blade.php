@extends('admin.layouts.app', ['page' => 'time_tables'])

@section('title', 'جدول دراسي')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">جدول دراسي</h3>

                <a class="pull-right btn btn-sm btn-success" href="{{ route('admin.add_period',['time_table'=>$time_table]) }}">
                    إضافة حصة جديدة
                </a>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>اليوم/الحصة</th>
                            <th>الاولى</th>
                            <th>الثانية</th>
                            <th>الثالثة</th>
                            <th>الرابعة</th>
                            <th>الخامسة</th>
                            <th>السادسة</th>
                            <th>السابعة</th>
                        </tr>
                </thead>   
                    <tbody>
                        @forelse($time_table->details as $day => $periods) 
                        <tr>
                            <th>{{$day}}</th>
                            @foreach ($periods as $period => $subject)
                                <td>{{$subject['subject']}}</td>
                            @endforeach
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="box-footer clearfix">
                {{-- {{ $time_tables->links('vendor.pagination.default') }} --}}
            </div>
        </div>
    </div>
</div>
@endsection