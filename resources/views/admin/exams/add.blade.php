@extends('admin.layouts.app', ['page' => 'exams'])

@section('title', 'إضافة موعد اختبار جديد')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">إضافة موعد اختبار جديد</h3>
            </div>

            <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.exams.store') }}">
                @csrf

                <div class="box-body">
                    <div class="form-group">
                        <label for="date">تاريخ الاختبار</label>
                        <input type="date"
                            class="form-control"
                            name="date"
                            required
                            placeholder="تاريخ الاختبار"
                            value="{{ old('date') }}"
                            id="date"/>
                    </div>
                    <div class="form-group">
                        <label for="grade">الصف</label>
                        <select  id="grade" name="grade_id" class="form-control">
                            @foreach($grades as $k=> $grade)
                                <option value="{{$grade->id }}" {{$grade->id == old('grade_id') ? ' selected="selected"' : '' }} >{{$grade->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="room">الفصل</label>
                        <select  id="room" name="room_id" class="form-control">
                            @foreach($rooms as $k=> $room)
                                <option value="{{$room->id }}" {{$room->id == old('room_id') ? ' selected="selected"' : '' }} >{{$room->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">المادة</label>
                        <select  id="subject" name="subject_id" class="form-control">
                            @foreach($subjects as $k=> $subject)
                                <option value="{{$subject->id }}" {{$subject->id == old('subject_id') ? ' selected="selected"' : '' }} >{{$subject->name}}</option>
                            @endforeach
                        </select>
                    </div>                   
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn bg-purple ">حفظ</button>

                    <a href="{{ route('admin.exams.index') }}" class="btn btn-default">
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
            url: 'http://school.test/api/ajax/exam',
            type: 'GET',
            data: {grade_id:gradeId},
            dataType: 'json',
            success:function(response){
                var rooms = response.data.rooms;
                var subjects = response.data.subjects;
                $("#room").empty();
                for (var i = 0; i < rooms.length; i++) {
                    var id = rooms[i]['id'];
                    var name = rooms[i]['name'];
                    $("#room").append("<option value='"+id+"'>"+name+"</option>");
                }            
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
