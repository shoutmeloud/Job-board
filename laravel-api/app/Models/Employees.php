<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\skills;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',   
        'country',
        'address',
        'about',
        'categoryid',        
        'skills',
        'cv',
        'profile_image',

    ];
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
   
    public function empskills()
    {
       // return $this->hasMany(Skills::class,'id',json_decode($this->skill_id));
        //return $this->belongsToJson(Skills::class,'id')->whereIn('id', ['1,2']);

        return $this->hasMany(Skills::class,'id')->where(function ($query) {
            $query->whereIn('id', [1,2]);
        });
    }

    public function category()
    {
        return $this->hasOne(EmployeeCategories::class, 'id','categoryid');
    }

    public function employeeskills()
    {
        $employeeskill = skills::whereIN('id', json_decode($this->skills, true))->get();
        return $employeeskill;
    }

    
}
