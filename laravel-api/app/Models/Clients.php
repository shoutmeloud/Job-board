<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;    
   
    protected $fillable = [
        'user_id',   
        'country',
        'address',
        'about',
        'refarralcode',
        'refarralpoints',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
