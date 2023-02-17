@extends('admin.layouts.app', ['page' => 'marks'])

@section('title', 'درجات الطلبة')
@section('styles')
{{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet"> --}}
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">درجات الطلبة</h3>
            </div>
            
            <div class="box-body">
                <table id="table" class="table table-responsive table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>الصف /الفصل</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    
                    @foreach ($students as $k=> $student)
                    
                        <tbody>

                            <tr class="clickable" data-toggle="collapse" data-target="#group-of-rows-{{$student->id}}" aria-expanded="false" aria-controls="group-of-rows-{{$student->id}}">
                                <td><i class="fa fa-plus" aria-hidden="true"></i></td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->grade->name.' / '.$student->room->name}}</td>
                                <td>
                                    <a href="{{ route('admin.marks.create', ['student_id' => $student->id]) }}">
                                        <span class="btn btn-warning">   <i class="fa fa-pencil-square-o"></i></span>
                                    </a>

                                    <a href="{{ route('admin.students.show', ['student' => $student->id]) }}">
                                        <span class="btn btn-info">   <i class="fa fa-eye"></i></span>
                                     </a>
     
                                </td>
                            </tr>
                        </tbody>
                        <tbody id="group-of-rows-{{$student->id}}" class="collapse">
                            @php
                                $total[0]=0;    
                                $total[1]=0;    
                            @endphp
                            @foreach ($student->marksGruoped() as $k=> $marks)
                                <tr>
                                    @php
                                        $total[0] += $marks[0]->value;
                                        $total[1] += $marks[1]->value?? 0 ;
                                    @endphp
                                    
                                    <td>{{ $marks[0]->subject->name }}</td>
                                        @foreach ($marks as $k=> $mark)
                                            <td>{{ $mark->value }}</td>
                                        @endforeach
                                        @if (count($marks) == 2)
                                            @php
                                                $tot = $marks->sum('value');
                                            @endphp
                                                  @if ($tot > 49)
                                                  <td style="background-color: lightgreen">{{ $tot }}</td>
                                                  @else
                                                  <td style="background-color: lightcoral">{{ $tot }}</td>
                                                  @endif                                            
                                        @endif
                                </tr>
                            @endforeach
                            <tr style="background-color: lightblue">
                                <td>المجموع</td>
                                <td>{{ $total[0] }}</td>
                                <td>{{ $total[1] }}</td>
                            </tr>
                            <tr style="background-color: skyblue">
                                <td> المجموع النهائي</td>
                                <td>{{ $total[0]  + $total[1] }}</td>
                            </tr>
                        </tbody>                        
                    @endforeach
                </table>
            </div>
            <div class="box-footer clearfix">
                {{-- {{ $marks->links('vendor.pagination.default') }} --}}
            </div>
        </div>        
    </div>
</div>
@endsection