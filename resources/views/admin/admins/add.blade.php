@extends('admin.layouts.app', ['page' => 'admins'])

@section('title', 'إضافة موظف جديد')

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">إضافة موظف جديد</h3>
            </div>    
<form role="form" method="POST" action="{{ route('admin.admins.store') }}">
    @csrf

    <div class="box-body">
        <div class="form-group">
            <label for="name">الإسم كامل</label>
            <input type="text"
                class="form-control"
                name="name"
                required
                placeholder="الإسم كامل"
                value="{{ old('name') }}"
                id="name"
            >
        </div>
      
        <div class="form-group">
            <label for="username">اسم المستخدم</label>
            <input type="text"
                class="form-control"
                name="username"
                required
                placeholder="اسم المستخدم"
                value="{{ old('username') }}"
                id="username"
            >
        </div>
        <div class="form-group">
            <label for="phone">رقم الهاتف</label>
            <input type="text"
                class="form-control"
                size="10"
                maxlength="10"
                minlength="10"
                name="phone"
                required
                placeholder="رقم الهاتف"
                value="{{ old('phone') }}"
                id="phone"
            >
        </div>              
      <div class="form-group">
            <label for="email">البريد الإلكتروني</label>
            <input type="text"
                class="form-control"
                name="email"
                required
                placeholder="البريد الإلكتروني"
                value="{{ old('email') }}"
                id="email"
            >
        </div>
        <div class="form-group">
            <label for="password">كلمة المرور</label>
            <input type="password"
                class="form-control"
                name="password"
                required
                placeholder="كلمة المرور"
                value="{{ old('password') }}"
                id="password"
            >
        </div>
    </div>

    <div class="box-footer">
        <button type="submit" class="btn bg-purple ">حفظ</button>

        <a href="{{ route('admin.admins.index') }}" class="btn btn-default">
            إلغاء
        </a>
    </div>
</form>
</div>
</div>
</div>
@endsection
