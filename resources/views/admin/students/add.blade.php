@extends('admin.layouts.app', ['page' => 'students'])

@section('title', 'إضافة طالب جديد')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">إضافة طالب جديد</h3>
            </div>

            <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.students.store') }}">
                @csrf

                <div class="box-body">
                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input type="text"
                            class="form-control"
                            name="name"
                            required
                            placeholder="الاسم"
                            value="{{ old('name') }}"
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
                            value="{{ old('birth_date') }}"
                            id="birth_date"
                        >
                    </div>
                    <div class="form-group">
                        <label for="gender">الجنس</label>
                        <select  id="gender" name="gender" class="form-control">
                            <option  value="ذكر">
                                ذكر</option>
                            
                            <option value="أنثى">
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
                            value="{{ old('email') }}"
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
                            value="{{ old('phone') }}"
                            id="phone"
                        >
                    </div>                 
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success">حفظ</button>

                    <a href="{{ route('admin.students.index') }}" class="btn btn-default">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
