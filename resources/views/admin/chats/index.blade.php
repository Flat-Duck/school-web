@extends('admin.layouts.app', ['page' => 'chats'])

@section('title', 'chats')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">اخر الرسائل</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>الجنس</th>
                        <th>نوع السكري</th>
                        <th>رقم الهاتف</th>
                        <th>مراسلة</th>
                    </tr>

                    @forelse ($users as $k=> $user)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>{{ $user->diabetes_type }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                <a href="{{ route('admin.chats.show', ['user' => $user->id]) }}">
                                    <i class="fa fa-pencil-square-o"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No records found</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
