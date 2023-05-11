<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Project extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = ['skills', 'name', 'image', 'project_url'];

    protected $casts = [
        'skills' => 'array'
    ];

    public function applications() {
        return $this->hasMany(Applications::class);
    }

    public function skill() {
        return $this->belongsTo(Skill::class);
    }
}
