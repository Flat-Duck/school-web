@extends('admin.layouts.app', ['page' => 'students'])

@section('title', 'تعديل طالب')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">تعديل طالب</h3>
            </div>

            <form role="form" method="POST" action="{{ route('admin.students.update', ['student' => $student->id]) }}">
                @csrf
                @method('PUT')

                <div class="box-body">
                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input type="text"
                            class="form-control"
                            name="name"
                            required
                            placeholder="الاسم"
                            value="{{ old('name', $student->name) }}"
                            id="name"
                        >
                    </div>
                        <div class="form-group">
                            <label for="n_id">الرقم الوطني</label>
                            <input type="text"
                            minlength="12"
                                maxlength="12" 
                                size="12"
                                class="form-control"
                                name="n_id"
                                required

                                placeholder="الرقم الوطني"
                                value="{{ old('n_id', $student->n_id) }}"
                                id="n_id"
                            >
                    </div>
                    <div class="form-group">
                        <label for="grade">الصف</label>
                        <select  id="grade" name="grade_id" class="form-control">
                            @foreach($grades as $k=> $grade)
                                <option value="{{$grade->id }}" {{$grade->id == old('grade_id',$student->room->grade_id) ? ' selected="selected"' : '' }} >{{$grade->name}}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="room">الفصل</label>
                        <select  id="room" name="room_id" class="form-control">
                            @foreach($rooms as $k=> $room)
                                <option value="{{$room->id }}" {{$room->id == old('room_id',$student->room_id) ? ' selected="selected"' : '' }} >{{$room->name}}</option>
                                
                            @endforeach
                        </select>
                    </div>                    
                    <div class="form-group">
                        <label for="birth_date">تاريخ الميلاد</label>
                        <input type="date"
                            class="form-control"
                            name="birth_date"
                            required
                            placeholder="تاريخ الميلاد"
                            value="{{ old('birth_date', $student->birth_date) }}"
                            id="birth_date"
                        >
                    </div>
                    <div class="form-group">
                        <label for="gender">الجنس</label>
                        <select  id="gender" name="gender" class="form-control">
                            <option  value="ذكر"  {{ 'ذكر' == old('gender',$student->gender) ? ' selected="selected"' : '' }}>
                                ذكر</option>
                            
                            <option value="أنثى"  {{ 'أنثى' == old('gender',$student->gender) ? ' selected="selected"' : '' }}>
                                أنثى</option>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">البريد الالكتروني الخاص بولي الامر</label>
                        <input type="email"
                            class="form-control"
                            name="email"
                            required
                            placeholder="البريد الالكتروني الخاص بولي الامر"
                            value="{{ old('email', $student->email) }}"
                            id="email"
                        >
                    </div>
                    <div class="form-group">
                        <label for="phone">رقم هاتف ولي الامر</label>
                        <input type="text"
                            class="form-control"
                            name="phone"
                            minlength="10"
                            maxlength="10"
                            size="10"
                            required
                            placeholder="رقم هاتف ولي الامر"
                            value="{{ old('phone', $student->phone) }}"
                            id="phone"
                        >
                    </div>                 
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn bg-purple ">تعديل</button>

                    <a href="{{ route('admin.students.index') }}" class="btn btn-default">
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
            }
        });
    }
});

</script>
@endsection
