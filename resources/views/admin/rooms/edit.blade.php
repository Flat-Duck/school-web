@extends('admin.layouts.app', ['page' => 'rooms'])

@section('title', 'تعديل فصل')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">تعديل فصل</h3>
            </div>

            <form role="form" method="POST" action="{{ route('admin.rooms.update', ['room' => $room->id]) }}">
                @csrf
                @method('PUT')

                <div class="box-body">
                    <div class="form-group">
                        <label for="grade">الصف</label>
                        <select  id="grade" name="grade_id" class="form-control">
                            @foreach($grades as $k=> $grade)
                                <option value="{{$grade->id }}" {{$grade->id == old('grade_id',$room->grade_id) ? ' selected="selected"' : '' }} >{{$grade->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name"> الفصل</label>
                        <input type="text"
                            class="form-control"
                            name="name"
                            required
                            max="toname()"
                            placeholder="المحتوى"
                            value="{{ old('name', $room->name) }}"
                            id="name"
                        >
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success">تعديل</button>

                    <a href="{{ route('admin.rooms.index') }}" class="btn btn-default">
                        إالغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
