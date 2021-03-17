<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audits extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(Image::class,'audit_id');
    }

    public function responses()
    {
        return $this->hasMany(Response::class,'audit_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
