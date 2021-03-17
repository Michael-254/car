<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activity_in_site extends Model
{
    use HasFactory;

    protected $fillable = ['site_in_weeks_id','todos','checked',];

    public function MonitoringActivities(){
        return $this->belongsTo(MonitoringActivity::class,'todos');
    }

    public function userplan(){
        return $this->hasOne(WeeklyPlan::class,'activity_in_sites_id');
    }

}
