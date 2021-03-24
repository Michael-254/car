<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $fillable = ['weekly_plans_id', 'title', 'checkbox', 'comment', 'state', 'car',];

    public function nonconformance()
    {
        return $this->belongsTo(Audits::class, 'audit_id');
    }

    public function fails()
    {
        return $this->hasMany(Audits::class, 'checklist_id');
    }
}
