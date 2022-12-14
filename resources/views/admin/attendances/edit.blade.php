@extends('admin.layouts.app', ['page' => 'attendances'])

@section('title', 'تعديل غياب')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">تعديل غياب</h3>
            </div>

            <form role="form" method="POST" action="{{ route('admin.attendances.update', ['attendance' => $attendance->id]) }}">
                @csrf
                @method('PUT')

                <div class="box-body">
                    <div class="form-group">
                        <label for="student">الطالب</label>
                        <select  id="student" name="student_id" class="form-control">
                            @foreach($students as $k=> $student)
                                <option value="{{$student->id }}" {{$student->id == old('student_id',$attendance->student_id) ? ' selected="selected"' : '' }} >{{$student->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="day">يوم الغياب</label>
                        <input type="date"
                            class="form-control"
                            name="day"
                            required
                            max="today()"
                            placeholder="المحتوى"
                            value="{{ old('day', $attendance->day) }}"
                            id="day"
                        >
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn bg-purple ">تعديل</button>

                    <a href="{{ route('admin.attendances.index') }}" class="btn btn-default">
                        إالغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
