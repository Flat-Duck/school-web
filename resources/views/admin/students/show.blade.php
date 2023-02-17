@extends('admin.layouts.app', ['page' => 'students'])

@section('title', 'كشف الدرجات')

@section('content')
<section class="invoice">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> إدارة تطبيق طفلي
                <small class="pull-right">التاريخ: {{ date('d-Y-M', time()) }}</small>
            </h2>
        </div>
    </div>
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">             
            <hr>
            
            اسم الطالب <b>: {{$student->name}}</b>  
            
            <br>
            <br>
            
            الفصل  <b>: <td>{{ $student->grade->name.' / '.$student->room->name}}</td></b>  
             
            <br>
            <br>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>اسم المادة</th>
                        <th>الفترة الاولى</th>
                        <th>الفترة الثانية</th>
                        <th> المجموع</th>
                    </tr>
                </thead>
                <tbody>              
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
            </table>
        </div>
    </div>
    
    <div class="row no-print">
        <div class="col-xs-12">
            <a onclick="window.print()" class="btn btn-default"><i class="fa fa-print"></i> طباعة</a>
        </div>
    </div>
</section>
@endsection