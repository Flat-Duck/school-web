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
                    <div class="form-group">
                        <label for="student">الصف</label>
                        <select disabled  id="students" name="student_id" class="form-control">
                            @foreach($students as $k=> $student)
                                <option value="{{$student->id }}" {{$student->id == old('student',$student->id) ? 'selected' : '' }} >{{$student->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="student" value="{{$student->id}}">
                    <div class="form-group">
                        <label for="period">الدرجة</label>
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
    loadMarks($("#grade").val());
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
                for (var i = 0; i < subjects.length; i++) {
                    var id = subjects[i]['id'];
                    var name = subjects[i]['name'];
                    $("#students").append("<option value='"+id+"'>"+name+"</option>");
                }
            }
        });
    }
    function loadMarks(gradeId) {
        $.ajax({
            url: 'http://school.test/api/ajax/marks',
            type: 'GET',
            data: {grade_id:gradeId},
            dataType: 'json',
            success:function(response){
                var subjects = response.data.subjects;          
                $("#subject").empty();
                for (var i = 0; i < subjects.length; i++) {                                    
                    $("#marks").append('<div class="form-group"><label for="'+subject+'">"'+subject+'"</label><input type="text"class="form-control"name="'+subject+'" placeholder="'+subject+'" value="{{ old("value") }}" id="value"></div>');
                }
            }
        });
    }
});

</script>
@endsection
