@extends('admin.layouts.app', ['page' => 'teachers'])

@section('title', 'إضافة معلم جديد')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">إضافة معلم جديد</h3>
            </div>

            <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.teachers.store') }}">
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
                        <label for="n_id">الرقم الوطني</label>
                        <input type="text"
                            class="form-control"
                            name="n_id"
                            required
                            placeholder="الرقم الوطني"
                            value="{{ old('n_id') }}"
                            id="n_id"
                        >
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
                        <label for="department">التخصص</label>
                        <input type="text"
                            class="form-control"
                            name="department"
                            required
                            placeholder="التخصص"
                            value="{{ old('department') }}"
                            id="department"
                        >
                    </div>
                    <div class="form-group">
                        <label for="email">البريد الالكتروني</label>
                        <input type="text"
                            class="form-control"
                            name="email"
                            required
                            placeholder="البريد الالكتروني"
                            value="{{ old('email') }}"
                            id="email"
                        >
                    </div>
                    <div class="form-group">
                        <label for="phone">رقم الهاتف</label>
                        <input type="text"
                            class="form-control"
                            name="phone"
                            required
                            placeholder="رقم الهاتف"
                            value="{{ old('phone') }}"
                            id="phone"
                        >
                    </div>                 
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn bg-purple ">حفظ</button>

                    <a href="{{ route('admin.teachers.index') }}" class="btn btn-default">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
