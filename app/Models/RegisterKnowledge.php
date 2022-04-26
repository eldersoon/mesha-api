<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterKnowledge extends Model
{
    use HasFactory;

    protected $table = 'register_knowledge';

    protected $fillable = [
        'register_id',
        'knowledge_id',
        'active',
    ];

    public function register() {
        return $this->belongsTo(Register::class);
    }

    public function knowledge() {
        return $this->belongsTo(Knowledge::class);
    }
}
