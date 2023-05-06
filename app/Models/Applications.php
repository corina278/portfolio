<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Applications extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = ['skill_id', 'name', 'cv', 'cover_letter', 'project_url'];

    public function skill() {
        return $this->belongsTo(Skill::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
