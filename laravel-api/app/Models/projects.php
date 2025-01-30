<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Skills;
use DB;

class projects extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'projecttitle',
        'projectdescription',
        'documentfile',
        'selectedemployeeid',
        'selectedemployee',
        'status'   
    ];

    public function comments()
    {
        return $this->hasMany(comments::class, 'project_id');
    }

    public function allrelateduser()
    {
   
        $selecteduser=array(); 
        if($this->selectedemployeeid!=''){
            $users= User::whereIN('id', json_decode($this->selectedemployeeid, true))
                ->with(['employee_profile', 'employee_profile.category'])
                ->get();
            foreach($users as $user){
                $selecteduser['userdetails'][]=$user;
                $killarray=$this->getuserskillset($user->employee_profile->skills);
                if($killarray)
                   $selecteduser['userskillsset'][$user->id]=$this->getuserskillset($user->employee_profile->skills);
                else  
                   $selecteduser['userskillsset'][$user->id]=array();
            }

        }

        //,'employee_profile.empskills'


        // $userids=json_decode($this->selectedemployeeid, true);
        // $users = User::whereIN('id',function($query) use ($userids) {
        //        $query->whereIN('users.id', $userids);
        // })->with(['employee_profile', 'employee_profile.category'])->get();
        
        //json_decode($this->selectedemployeeid, true))
        return $selecteduser;
    }


    public function getuserskillset($sakillid)
    {
        $skillset=skills::whereIN('id',json_decode($sakillid, true))->get();
        return  $skillset;
       
    }
    
    public function User()
    {
        return $this->hasOne(User::class, 'id','client_id');
    }
}
