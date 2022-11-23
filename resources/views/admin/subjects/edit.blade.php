@extends('admin.layouts.app', ['page' => 'subjects'])

@section('title', 'تعديل مادة دراسية')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">تعديل مادة دراسية</h3>
            </div>

            <form role="form" method="POST" action="{{ route('admin.subjects.update', ['subject' => $subject->id]) }}">
                @csrf
                @method('PUT')                
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">إسم االمادة</label>
                        <input type="text"
                            class="form-control"
                            name="name"
                            required
                            placeholder="إسم االمادة"
                            value="{{ old('name',$subject->name) }}"
                            id="name"
                        >
                    </div>


                    <div class="form-group">
                        <label for="grade">الفصول</label>
                        <select  id="grade" name="grade_id[]" multiple class="form-control">
                            @foreach($grades as $k=> $grade)
                                <option value="{{$grade->id }}" {{in_array($grade->id, $subject->grades->pluck('id')->flatten()->toArray()) ? ' selected="selected"' : '' }} >{{$grade->name}}</option>
                            @endforeach
                        </select>
                    </div>
                   
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success">تعديل</button>

                    <a href="{{ route('admin.subjects.index') }}" class="btn btn-default">
                        إالغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
