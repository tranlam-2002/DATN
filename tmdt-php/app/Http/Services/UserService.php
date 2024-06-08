<?php


namespace App\Http\Services;

use App\Models\User;


class UserService
{
     
    public function getUser(){
        return User::orderByDesc('id')->paginate(15);
    }
    
    // public function getshow($customer)
    // {
    //     return $customer->carts()->with(['product' => function ($query) {
    //         $query->select('id', 'name');
    //     }])->get();
    // }
    public function destroy($request)
    {
        $user = User::where('id', $request->input('id'))->first();
        if ($user) {
            $user->delete();
            return true;
        }

        return false;
    }
}  