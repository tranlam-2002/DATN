<?php

namespace App\Http\Services;

use App\Models\ContactMessage;
use Illuminate\Support\Facades\Storage;

class ContactService{
    public function getContact(){
        return ContactMessage::orderByDesc('id')->paginate(15);
    }
    public function delete($request){
      $slider = ContactMessage::where('id',$request->input('id'))->first();
      if($slider){
        $path = str_replace('storage', 'public', $slider->thumb);
        Storage::delete($path);
        $slider->delete();
        return true;
      }
      return false;
    }    
}