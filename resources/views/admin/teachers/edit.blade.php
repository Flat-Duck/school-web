@extends('admin.layouts.app', ['page' => 'teachers'])

@section('title', 'تعديل معلم')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">تعديل معلم</h3>
            </div>
            
            <form role="form" method="POST" action="{{ route('admin.teachers.update', ['teacher' => $teacher->id]) }}">
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
                        value="{{ old('name', $teacher->name) }}"
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
                        value="{{ old('n_id', $teacher->n_id) }}"
                        id="n_id"
                    >
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
                    <label for="department">التخصص</label>
                    <input type="text"
                        class="form-control"
                        name="department"
                        required
                        placeholder="التخصص"
                        value="{{ old('department',$teacher->department) }}"
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
                        value="{{ old('email', $teacher->email) }}"
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
                        value="{{ old('phone', $teacher->phone) }}"
                        id="phone"
                    >
                </div>                 
            </div>

                        

                <div class="box-footer">
                    <button type="submit" class="btn bg-purple ">تعديل</button>

                    <a href="{{ route('admin.teachers.index') }}" class="btn btn-default">
                        إالغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
