@extends('admin.layouts.app', ['page' => 'notes'])

@section('title', 'تعديل ملاحظة')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">تعديل ملاحظة</h3>
            </div>

            <form role="form" method="POST" action="{{ route('admin.notes.update', ['note' => $note->id]) }}">
                @csrf
                @method('PUT')

                <div class="box-body">
                    <div class="form-group">
                        <label for="student">الطالب</label>
                        <select  id="student" name="student_id" class="form-control">
                            @foreach($students as $k=> $student)
                                <option value="{{$student->id }}" {{$student->id == old('student_id',$note->student_id) ? ' selected="selected"' : '' }} >{{$student->name}}</option>
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
                            value="{{ old('content', $note->content) }}"
                            id="content"
                        >
                    </div>               
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success">تعديل</button>

                    <a href="{{ route('admin.notes.index') }}" class="btn btn-default">
                        إالغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
