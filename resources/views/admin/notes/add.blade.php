@extends('admin.layouts.app', ['page' => 'notes'])

@section('title', 'إضافة ملاحظة جديد')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">إضافة ملاحظة جديد</h3>
            </div>

            <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.notes.store') }}">
                @csrf

                <div class="box-body">
                    <div class="form-group">
                        <label for="student">الطالب</label>
                        <select  id="student" name="student_id" class="form-control select2">
                            @foreach($students as $k=> $student)
                                <option value="{{$student->id }}" {{$student->id == old('student_id') ? ' selected="selected"' : '' }} >{{$student->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="content">المحتوى</label>
                        <input type="textarea"
                            class="form-control"
                            name="content"
                            required
                            placeholder="المحتوى"
                            value="{{ old('content') }}"
                            id="content"
                        >
                    </div>                
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn bg-purple ">حفظ</button>

                    <a href="{{ route('admin.notes.index') }}" class="btn btn-default">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
