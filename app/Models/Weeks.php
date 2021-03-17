<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weeks extends Model
{
    use HasFactory;

    protected $fillable = ['week'];

    public function sitess()
    {
        return $this->hasMany(site_in_Week::class);
    }
}
