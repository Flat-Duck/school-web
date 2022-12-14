@extends('admin.layouts.app', ['page' => 'subjects'])

@section('title', 'إضافة مادة دراسية جديد')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">إضافة مادة دراسية جديدة</h3>
            </div>

            <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.subjects.store') }}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">إسم المادة</label>
                        <input type="text"
                            class="form-control"
                            name="name"
                            required
                            placeholder="إسم المادة"
                            value="{{ old('name') }}"
                            id="name"
                        >
                    </div>

                    <div class="form-group">
                        <label for="grade">الصفوف</label>
                        <select  id="grade" name="grade_id[]"  class="form-control select2" multiple>
                            @foreach($grades as $k=> $grade)
                                <option value="{{$grade->id }}" {{$grade->id == old('grade_id') ? ' selected="selected"' : '' }} >{{$grade->name}}</option>
                            @endforeach
                        </select>
                    </div>                 
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn bg-purple ">حفظ</button>

                    <a href="{{ route('admin.subjects.index') }}" class="btn btn-default">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
