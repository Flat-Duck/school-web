@extends('admin.layouts.app', ['page' => 'chats'])

@section('title', 'chats')

@section('content')

    <div class="box box-primary direct-chat direct-chat-primary">
        <div class="box-header with-border">
            <h3 class="box-title">رسالةمباشرة</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages">
                @foreach ($chats as $chat)
                <div class="direct-chat-msg {{ $chat->ismine?'right':'' }}">
                    <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name {{ $chat->ismine?'':'pull-left' }} "> {{ $chat->ismine? $chat->admin->name : $chat->user->name }} </span>
                        <span class="direct-chat-timestamp pull-right">{{ $chat->created_at->diffForHumans() }}</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    {{-- <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="M"> --}}
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        {{ $chat->message }}
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                @endforeach
                <!-- Message. Default to the left -->
            </div>
            <!--/.direct-chat-messages-->

           
            <!-- /.direct-chat-pane -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <form action="{{ route('admin.chats',['user'=>$chat->user->id]) }}" method="post">
                @csrf
                <div class="input-group">
                    <input type="text" name="message" placeholder="أكتب رسالة" class="form-control">
                    <span class="input-group-btn">
                        <button type="submit" class="btn bg-purple  btn-flat">إرسال</button>
                    </span>
                </div>
            </form>
        </div>
        <!-- /.box-footer-->
    </div>
    <!--/.direct-chat -->
@endsection
