<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringActivity extends Model
{
    use HasFactory;
    protected $fillable = ['list'];

    public function mysons(){
        return $this->hasMany(MAchild::class,'monitoring_activities_id');
    }
}
