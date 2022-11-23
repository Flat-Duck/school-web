@extends('admin.layouts.app', ['page' => 'attendances'])

@section('title', 'إضافة غياب جديد')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">إضافة غياب جديد</h3>
            </div>

            <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.attendances.store') }}">
                @csrf

                <div class="box-body">
                    <div class="form-group">
                        <label for="student">الطالب</label>
                        <select  id="student" name="student_id" class="form-control">
                            @foreach($students as $k=> $student)
                                <option value="{{$student->id }}" {{$student->id == old('student_id') ? ' selected="selected"' : '' }} >{{$student->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="day">يوم الغياب</label>
                        <input type="date"
                            class="form-control"
                            name="day"
                            required
                            placeholder="المحتوى"
                            value="{{ old('day') }}"
                            id="day"
                        >
                    </div>                
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success">حفظ</button>

                    <a href="{{ route('admin.attendances.index') }}" class="btn btn-default">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
