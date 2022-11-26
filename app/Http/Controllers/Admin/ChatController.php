<?php

namespace App\Http\Controllers\Admin;

use App\Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ChatController extends Controller
{
    
        public function index()
        {
          $chats =  Chat::where('admin_id',auth()->user()->id)->get();
          $users = collect(new User);
          foreach ($chats as $k => $chat) {
              $user = $chat->user;
              if (!$users->contains($user)) {
                  $users->add($user);
              }
          }
    
            return view('admin.chats.index',compact('users'));
        }
        public function show(User $user)
        {
          $allChats =  Chat::where(['admin_id'=>auth()->user()->id,'user_id'=>$user->id])->get();
          
          foreach ($allChats as $k => $chat) {
            if ($chat->sender_id != auth()->user()->id) {
                $chat['ismine'] = false;
            }else{
                $chat['ismine'] = true;
            }
            $chats[$k] = $chat;
        }
            return view('admin.chats.show',compact('chats'));
        }
    
        public function send(User $user)
        {
            $chat = new Chat();
            $chat->admin_id = auth()->user()->id;
            $chat->sender_id = auth()->user()->id;
            $chat->user_id = $user->id;
            $chat->message = request()->message;
            $chat->save();
    
        
            return redirect()->route('admin.chats.show',['user'=>$user->id]);
        }
    
    }
    