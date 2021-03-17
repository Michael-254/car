<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyPlan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','site','activity_in_sites_id','date',
                           'inspected','findings','comment','task_completed','audit_id'];

    public function userowner(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function activityParent(){
        return $this->belongsTo(activity_in_site::class,'activity_in_sites_id');
    }

    public function checks(){
        return $this->hasMany(Checklist::class,'weekly_plans_id');
    }
    
    public function nonconformance(){
        return $this->belongsTo(Audits::class,'audit_id');
    }
}
