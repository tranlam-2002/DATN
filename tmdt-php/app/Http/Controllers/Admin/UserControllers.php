<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class UserControllers extends Controller
{
    protected $user;
    public function __construct(UserService $user)
    {
        $this->user=$user;
    }
    public function index(){
        return view('admin.users.list', [
           'title'=> 'Danh sách khách hàng',
           'users'=>$this->user->getUser() 
        ]);
    }
    // public function show(User $user){
    //     $user = $this->user->getShow($user);
    //     return view('admin.users.detail',[
    //         'title'=> 'Chi tiết khách hàng',
    //         'users'=>$user
    //     ]);
    // }
    
    public function destroy(Request $request){
        $result = $this->user->destroy($request);
        if($result){
            return response()->json([
                'error'=> false,
                'message'=> 'Xóa thành công khách hàng'
            ]);
        }
        return response()->json(['error' => true]);
    }
}