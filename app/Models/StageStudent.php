<?php

namespace App\Models;

use App\Enums\ClearanceStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StageStudent extends Model
{
    use HasFactory;
    protected $table = 'stage_student';

    protected $guarded = ['id'];
    protected $casts = [
        'created_at' => 'date',
    ];

    public function student() : BelongsTo {
        return $this->belongsTo(Student::class);
    }

    public function moderator() : BelongsTo {
        return $this->belongsTo(User::class, 'moderator_id');
    }

    public function stage() : BelongsTo {
        return $this->belongsTo(Stage::class);
    }


    public function scopeApproved($query) {
        return $query->whereStatus(ClearanceStatusEnum::APPROVED->value);
    }

    public function scopeDeclined($query) {
        return $query->whereStatus(ClearanceStatusEnum::DECLINED->value);
    }
}
