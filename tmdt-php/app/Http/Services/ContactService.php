<?php

namespace App\Http\Services;

use App\Models\ContactMessage;

class ContactService{
    public function getContact(){
        return ContactMessage::orderByDesc('id')->paginate(15);
    }
}