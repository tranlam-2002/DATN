<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
            'user_id',
            'name',
            'phone',
            'address',
            'email',
            'content',
            'status',
            'delivered', 
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function carts(){
        return $this->hasMany(Cart::class, 'customer_id','id');
    }
    
}