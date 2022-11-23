@extends('admin.layouts.app', ['page' => 'students'])

@section('title', 'تعديل طالب')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">تعديل طالب</h3>
            </div>

            <form role="form" method="POST" action="{{ route('admin.students.update', ['student' => $student->id]) }}">
                @csrf
                @method('PUT')

                <div class="box-body">
                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input type="text"
                            class="form-control"
                            name="name"
                            required
                            placeholder="الاسم"
                            value="{{ old('name', $student->name) }}"
                            id="name"
                        >
                    </div>
                    <div class="form-group">
                        <label for="birth_date">تاريخ الميلاد</label>
                        <input type="text"
                            class="form-control"
                            name="birth_date"
                            required
                            placeholder="تاريخ الميلاد"
                            value="{{ old('birth_date', $student->birth_date) }}"
                            id="birth_date"
                        >
                    </div>
                    <div class="form-group">
                        <label for="gender">الجنس</label>
                        <select  id="gender" name="gender" class="form-control">
                            <option  value="ذكر"  {{ 'ذكر' == old('gender',$teacher->gender) ? ' selected="selected"' : '' }}>
                                ذكر</option>
                            
                            <option value="أنثى"  {{ 'أنثى' == old('gender',$teacher->gender) ? ' selected="selected"' : '' }}>
                                أنثى</option>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">البريد الالكتروني الخاص بولي الامر</label>
                        <input type="text"
                            class="form-control"
                            name="email"
                            required
                            placeholder="البريد الالكتروني الخاص بولي الامر"
                            value="{{ old('email', $student->email) }}"
                            id="email"
                        >
                    </div>
                    <div class="form-group">
                        <label for="phone">رقم هاتف ولي الامر</label>
                        <input type="text"
                            class="form-control"
                            name="phone"
                            required
                            placeholder="رقم هاتف ولي الامر"
                            value="{{ old('phone', $student->phone) }}"
                            id="phone"
                        >
                    </div>                 
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">تعديل</button>

                    <a href="{{ route('admin.students.index') }}" class="btn btn-default">
                        إالغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
