<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\ContactService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    protected $contact;
    public function __construct(ContactService $contact){
        $this->contact=$contact;
    }
    public function index()
    {
        return view('admin.contact.index',[
            'title'=>'Danh sách khách hàng liên hệ',
            'contacts'=>$this->contact->getContact()
        ]);
    }
        public function destroy(Request $request){
        $result = $this->contact->delete($request);
        if($result){
            return response()->json([
                'error'=> false,
                'message'=> 'Xóa thành công liên hệ'
            ]);
        }
        return response()->json(['error' => true]);
    }
}