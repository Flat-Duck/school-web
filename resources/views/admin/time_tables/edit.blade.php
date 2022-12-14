@extends('admin.layouts.app', ['page' => 'time_tables'])

@section('title', 'تعديل جدول دراسي')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">تعديل جدول دراسي</h3>
            </div>

            <form role="form" method="POST" action="{{ route('admin.time_tables.update', ['time_table' => $time_table->id]) }}">
                @csrf
                @method('PUT')
                <div class="box-body">
                    <div class="form-group">
                        <label for="grade">الصف</label>
                        <select  id="grade" name="grade_id" class="form-control">
                            @foreach($grades as $k=> $grade)
                                <option value="{{$grade->id }}" {{$grade->id == old('grade_id',$time_table->grade_id) ? ' selected="selected"' : '' }} >{{$grade->name}}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="room">الفصل</label>
                        <select  id="room" name="room_id" class="form-control">
                            @foreach($rooms as $k=> $room)
                                <option value="{{$room->id }}" {{$room->id == old('room_id',$time_table->room_id) ? ' selected="selected"' : '' }} >{{$room->name}}</option>
                                
                            @endforeach
                        </select>
                    </div>                    
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn bg-purple ">تعديل</button>

                    <a href="{{ route('admin.time_tables.index') }}" class="btn btn-default">
                        إالغاء
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
