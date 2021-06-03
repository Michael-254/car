<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUpdate extends Model
{
    use HasFactory;

    protected $fillable = [ 'audit_id', 'saying', 'user_id','file'];
}
