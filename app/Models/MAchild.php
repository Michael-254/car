<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MAchild extends Model
{
    use HasFactory;

    protected $fillable = ['monitoring_activities_id','sons'];
}
