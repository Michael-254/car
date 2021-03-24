<?php

namespace App\Models;

use App\Http\Livewire\FollowUp;
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

    public function HODs()
    {
        return $this->belongsTo(User::class,'hod_id');
    }

    public function sayings()
    {
        return $this->hasMany(FollowUpdate::class,'audit_id');
    }

}
