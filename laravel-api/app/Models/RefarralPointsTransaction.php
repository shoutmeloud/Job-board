<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefarralPointsTransaction extends Model
{
    use HasFactory;    
   
    protected $fillable = [
        'client_id',   
        'referred_by',
        'usertype',
        'refarralpoints',
        'status',
        'note',
    ];

    public function User()
    {
        return $this->hasOne(User::class, 'id','referred_by');
    }
  
}
