<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'audit_id',
        'cause',
        'proposed_solution',
        'proposed_date',
        'owner',
        'progress'
    ];
}
