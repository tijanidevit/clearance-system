<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function moderator() : BelongsTo {
        return $this->belongsTo(User::class, 'moderator_id')->withTrashed();
    }

    public function stageStudents() : HasMany {
        return $this->hasMany(StageStudent::class);
    }

    public function session() : BelongsTo {
        return $this->belongsTo(SchoolSession::class, 'school_session_id');
    }
}
