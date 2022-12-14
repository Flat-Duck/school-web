@extends('admin.layouts.app', ['page' => 'grades'])

@section('title', 'تعديل صف دراسي')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">تعديل صف دراسي</h3>
            </div>

            <form role="form" method="POST" action="{{ route('admin.grades.update', ['grade' => $grade->id]) }}">
                @csrf
                @method('PUT')                
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">إسم االصف</label>
                        <input type="text"
                            class="form-control"
                            name="name"
                            required
                            placeholder="إسم االصف"
                            value="{{ old('name',$grade->name) }}"
                            id="name"
                        >
                    </div>

{{-- 
                    <div class="form-group">
                        <label for="grade">الفصول</label>
                        <select  id="grade" name="grade_id" multiple class="form-control">
                            @foreach($grades as $k=> $grade)
                                <option value="{{$grade->id }}" {{$grade->id == old('grade_id',$grade->grade_id) ? ' selected="selected"' : '' }} >{{$grade->name}}</option>
                            @endforeach
                        </select>
                    </div> --}}
                   
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn bg-purple ">تعديل</button>

                    <a href="{{ route('admin.grades.index') }}" class="btn btn-default">
                        إالغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
