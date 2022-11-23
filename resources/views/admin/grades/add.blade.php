@extends('admin.layouts.app', ['page' => 'grades'])

@section('title', 'إضافة صف دراسي جديد')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">إضافة صف دراسي جديد</h3>
            </div>

            <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.grades.store') }}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">الصف</label>
                        <input type="text"
                            class="form-control"
                            name="name"
                            required
                            placeholder="الصف"
                            value="{{ old('name') }}"
                            id="name"
                        >
                    </div>
{{-- 
                    <div class="form-group">
                        <label for="grade">الفصول</label>
                        <select  id="grade" name="grade_id"  class="form-control select2" multiple>
                            @foreach($grades as $k=> $grade)
                                <option value="{{$grade->id }}" {{$grade->id == old('grade_id',$grade->grade_id) ? ' selected="selected"' : '' }} >{{$student->name}}</option>
                            @endforeach
                        </select>
                    </div>                 
                </div> --}}

                <div class="box-footer">
                    <button type="submit" class="btn btn-success">حفظ</button>

                    <a href="{{ route('admin.grades.index') }}" class="btn btn-default">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
