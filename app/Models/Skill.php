<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;



class Skill extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = ['name', 'image'];

    public function project(){
        return $this->hasMany(Project::class);
    }
}
