<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCategories extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',   
        'status',
    ];

    public function Employeecategory(){
        return $this->belongsTo(Employees::class, 'categoryid','id');
    }
}
