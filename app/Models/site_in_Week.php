<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class site_in_Week extends Model
{
    use HasFactory;

    protected $fillable = ['weeks_id','week_name','site',];

    public function monitorings()
    {
        return $this->hasMany(activity_in_site::class,'activity__for_weeks');
    }
}
