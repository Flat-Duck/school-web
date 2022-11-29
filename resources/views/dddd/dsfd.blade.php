

                {{-- <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>الصف /الفصل</th>
                        <th>المادة</th>
                        <th>الفترة الاولى / 30</th>
                        <th>الفترة الثانية / 30</th>
                        <th>الفترة الثالثة / 40</th>
                        <th>المجموع / 100</th>
                        <th>العمليات</th>
                    </tr>
                </thead>   
                    <tbody>
                        @php
                        $i=0;
                        @endphp
                    @forelse ($marks as $k=> $mark)
                    @if ($mark->student->IsBeginner())
                        
                    
                    <table id="table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>الصف /الفصل</th>
                                {{-- <th>المادة</th>
                                <th>الفترة الاولى / 30</th>
                                <th>الفترة الثانية / 30</th>
                                <th>الفترة الثالثة / 40</th>
                                <th>المجموع / 100</th>
                                <th>العمليات</th> 
                            </tr>
                        </thead>   
                            <tbody>
                                <tr>
                                    <td>{{ $mark->student->name }}</td>
                                    <td>{{ $mark->student->grade->name.' / '.$mark->student->room->name}}</td>                            
                                    <td>{{ $mark->subject->name }}</td>
                                </tr>
                            </tbody>
                    </table>


                        <tr>
                            <td>{{ $i+=1}}</td>
                            <td>{{ $mark->student->name }}</td>
                            <td>{{ $mark->student->grade->name.' / '.$mark->student->room->name}}</td>                            
                            <td>{{ $mark->subject->name }}</td>
                            {{-- @php
                                $x1 = empty($student->marks[0])? 0 : $student->marks[0]->value;
                                $x2 = empty($student->marks[1])? 0 : $student->marks[1]->value;
                                $x3 = empty($student->marks[2])? 0 : $student->marks[2]->value;
                            @endphp --}}
                            {{-- <td>{{ empty($student->marks[0])? '-' : $student->marks[0]->value }}</td>
                            <td>{{ empty($student->marks[1])? '-' : $student->marks[1]->value }}</td>

                            <td>{{ empty($student->marks[2])? '-' : $student->marks[2]->value }}</td> --}}
                            {{-- <td>{{ $x1+$x2+$x3 }}</td> 
                            
                            
                            
                            <td>
                                <a href="{{ route('admin.marks.create', ['student_id' => $mark->student->id]) }}">
                                   <span class="btn btn-warning">   <i class="fa fa-pencil-square-o"></i></span>
                                </a>                                
                            </td>
                        </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="8">لا توجد سجلات</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>

            <div class="box-footer clearfix">
                {{-- {{ $marks->links('vendor.pagination.default') }} 
            </div>
        </div>
    </div>
</div> --}}
{{-- <div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">درجات الطلبة من صف رابع الى صف سادس</h3>
            </div>
            <div class="box-body">
                <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>الصف /الفصل</th>
                        <th>الفترة الاولى / 40</th>
                        <th>الفترة الثانية / 60</th>
                        <th>المجموع / 100</th>
                        <th>العمليات</th>
                    </tr>
                </thead>   
                    <tbody>
                        @php
                        $i=0;
                        @endphp
                    @forelse ($marks as $k=> $mark)
                    @if (!$ssstudent->IsBeginner())
                        
                    
                        <tr>
                            <td>{{ $i+=1}}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->grade->name.' / '.$student->room->name}}</td>                            
                            @php
                                $x1 = empty($student->marks[0])? 0 : $student->marks[0]->value;
                                $x2 = empty($student->marks[1])? 0 : $student->marks[1]->value;                                
                            @endphp
                            <td>{{ empty($student->marks[0])? '-' : $student->marks[0]->value }}</td>
                            <td>{{ empty($student->marks[1])? '-' : $student->marks[1]->value }}</td>
                            <td>{{ $x1+$x2}}</td>
                            
                            
                            <td>
                                <a href="{{ route('admin.marks.create', ['student_id' => $student->id]) }}">
                                   <span class="btn btn-warning">   <i class="fa fa-pencil-square-o"></i></span>
                                </a>                                
                            </td>
                        </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="7">لا توجد سجلات</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>

            <div class="box-footer clearfix">
                {{ $marks->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
</div> --}}