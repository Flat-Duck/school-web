@extends('admin.layouts.app', ['page' => 'marks'])

@section('title', 'إضافة درجة جديدة')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">إضافة درجة جديدة</h3>
            </div>

            <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.save_mark',['student'=>$student]) }}">
                @csrf

                <div class="box-body">   
                    {{-- <div class="form-group">
                        <label for="grade">الصف</label>
                        <select  id="grade" name="grade_id" class="form-control">
                            @foreach($grades as $k=> $grade)
                                <option value="{{$grade->id }}" {{$grade->id == old('grade_id') ? ' selected="selected"' : '' }} >{{$grade->name}}</option>
                            @endforeach
                        </select>
                    </div>                 --}}
                    <div class="form-group">
                        <label for="student">الطالب</label>
                        <select disabled id="students" name="students" class="form-control">
                            @foreach($students as $k=> $stud)
                                <option value="{{$stud->id }}" {{$stud->id == old('students',$student->id) ? 'selected' : '' }} >{{$stud->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="student" value="{{$student->id}}">
                    <div class="form-group">
                        <label for="period">الفترة</label>
                        <select id="period" name="period" class="form-control">
                            @foreach($periods as $k=> $period)
                                <option value="{{$period }}" {{$period == old('period') ? ' selected="selected"' : '' }} >{{$period}}</option>
                            @endforeach
                        </select>
                    </div>
                <div id="marks">

                </div>                    
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn bg-purple ">حفظ</button>

                    <a href="{{ URL::previous() }}" class="btn btn-default">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready( function () {
    loadStudents( $("#grade").val());
   loadMarks($("#students").val());
    $("#grade").change(function(){
        var gradeId = $(this).val();
        loadStudents(gradeId);
    });
    function loadStudents(gradeId) {
        $.ajax({
            url: 'http://school.test/api/ajax/students',
            type: 'GET',
            data: {grade_id:gradeId},
            dataType: 'json',
            success:function(response){
                var students = response.data.students;
                $("#students").empty();
                for (var i = 0; i < students.length; i++) {
                    var id = students[i]['id'];
                    var name = students[i]['name'];
                    $("#students").append("<option value='"+id+"'>"+name+"</option>");
                }
            }
        });
    }
    function loadMarks(studentId) {
        $.ajax({
            url: 'http://school.test/api/ajax/marks',
            type: 'GET',
            data: {student_id:studentId},
            dataType: 'json',
            success:function(response){
                var subjects = response.data.subjects;   
              //  console.log(subjects);
                $("#subject").empty();
                for (var i = 0; i < subjects.length; i++) {                                    
                    var id = subjects[i]['id'];
                    var name = subjects[i]['name'];
                    $("#marks").append('<div class="form-group"><label for='+id+'>'+name+'</label><input type="number" class="form-control" name='+id+' placeholder='+name+' value="{{ old("value") }}" id='+id+'></div>');
                }
            }
        });
    }
});

</script>
@endsection

{{-- @extends('admin.layouts.app', ['page' => 'marks']) --}}

{{-- @section('title', 'إضافة درجة جديدة') --}}

{{-- @section('content') --}}
{{-- <div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">إضافة درجة جديدة</h3>
            </div>

            <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.marks.store',['student'=>$student]) }}">
                @csrf

                <div class="box-body">                   
                    <div class="form-group">
                        <label for="student">اسم الطالب</label>
                        <select disabled id="student" name="student" class="form-control">
                            @foreach($students as $k=> $std)
                                <option value="{{$std->id }}" {{$std->id == old('std',$student->id) ? 'selected' : '' }} >{{$std->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="student_id" id="student_id" value="{{$student->id}}">
                    <div class="form-group">
                        <label for="subject">المادة</label> 
                        <select  id="subject" name="subject_id" class="form-control">
                             @foreach($subjects as $k=> $subject)
                                <option value="{{$subject->id }}" {{$subject->id == old('subject_id') ? ' selected="selected"' : '' }} >{{$subject->name}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="period">الفترة</label>
                        <select  id="period" name="period" class="form-control">
                            @foreach($periods as $k=> $period)
                            {{((!$student->IsBeginner()) && ($period == 'الفترة الثالثة'))? 'disabled': '' }}
                                <option value="{{$period }}" {{$period == old('period') ? 'selected="selected"' : '' }} >{{$period}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="value">الدرجة</label>
                        <input type="text"
                            class="form-control"
                            name="value"
                            required
                            placeholder="الدرجة"
                            value="{{ old('value') }}"
                            id="value"
                        >
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn bg-purple ">حفظ</button>

                    <a href="{{ URL::previous() }}" class="btn btn-default">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready( function () {
    loadData( $("#student_id").val());    
    function loadData(student_id) {
        $.ajax({
            url: 'http://school.test/api/ajax/marks',
            type: 'GET',
            data: {student_id:student_id},
            dataType: 'json',
            success:function(response){
                var subjects = response.data.subjects;
                $("#subject").empty();
                for (var i = 0; i < subjects.length; i++) {
                    var id = subjects[i]['id'];
                    var name = subjects[i]['name'];
                    $("#subject").append("<option value='"+id+"'>"+name+"</option>");
                }
            }
        });
    }
});

</script>
@endsection
 --}}