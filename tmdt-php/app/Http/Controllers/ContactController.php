<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Models\ContactMessage;

class ContactController extends Controller
{
        public function contact(){
        return view('contact',[
            'title'=>'Liên Hệ'
        ]);
    }
    public function postContact(Request $request)
    {
        $request->validate([
        'email' => 'required|email',
        'message' => 'required',
    ]);

    // Lưu tin nhắn liên hệ vào cơ sở dữ liệu
    $contactMessage = ContactMessage::create([
        'email' => $request->email,
        'message' => $request->message,
    ]);
        // Gửi email đến quản trị viên
        Mail::to('tranlam2782002@gmail.com')->send(new ContactMail( $contactMessage));

        return back()->with('success', 'Lời nhắn của bạn đã được gửi đi thành công!');
    }
}