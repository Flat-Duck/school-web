@extends('admin.layouts.app', ['page' => 'rooms'])

@section('title', 'إضافة فصل جديد')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">إضافة فصل جديد</h3>
            </div>

            <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.rooms.store') }}">
                @csrf

                <div class="box-body">
                    <div class="form-group">
                        <label for="grade">الصف</label>
                        <select  id="grade" name="grade_id" class="form-control">
                            @foreach($grades as $k=> $grade)
                                <option value="{{$grade->id }}" {{$grade->id == old('grade_id') ? ' selected="selected"' : '' }} >{{$grade->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name"> الفصل</label>
                        <input type="text"
                            class="form-control"
                            name="name"
                            required
                            placeholder="الفصل"
                            value="{{ old('name') }}"
                            id="name"
                        >
                    </div>                
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn bg-purple ">حفظ</button>

                    <a href="{{ route('admin.rooms.index') }}" class="btn btn-default">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
