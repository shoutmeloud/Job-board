<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','project_id','comments'     
    ];

    public function users(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
