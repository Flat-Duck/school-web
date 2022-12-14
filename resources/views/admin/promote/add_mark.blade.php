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
                        <select disabled  id="student" name="student" class="form-control">
                            @foreach($students as $k=> $student)
                                <option value="{{$student->id }}" {{$student->id == old('student',$student->id) ? 'selected' : '' }} >{{$student->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="student" value="{{$student->id}}">
                    <div class="form-group">
                        <label for="period">الدرجة</label>
                        <select  id="period" name="period" class="form-control">
                            @foreach($periods as $k=> $period)
                                <option value="{{$period }}" {{$period == old('period') ? ' selected="selected"' : '' }} >{{$period}}</option>
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
    loadData( $("#grade").val());
    $("#grade").change(function(){
        var gradeId = $(this).val();
        loadData(gradeId);
    });
    function loadData(gradeId) {
        $.ajax({
            url: 'http://school.test/api/ajax/time_table',
            type: 'GET',
            data: {grade_id:gradeId},
            dataType: 'json',
            success:function(response){
                var rooms = response.data.rooms;
                var subjects = response.data.subjects;
           //     $("#room").empty();
             //   for (var i = 0; i < rooms.length; i++) {
               //     var id = rooms[i]['id'];
                //    var name = rooms[i]['name'];
                 //   $("#room").append("<option value='"+id+"'>"+name+"</option>");
               // }            
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
