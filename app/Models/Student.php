<?php

namespace App\Models;

use App\Enums\StudentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'date',
    ];


    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function stages() : BelongsToMany {
        return $this->belongsToMany(Stage::class);
    }

    public function stageStudents() : HasMany {
        return $this->hasMany(StageStudent::class);
    }

    public function scopePending($query) {
        return $query->whereStatus(StudentStatusEnum::PENDING->value);
    }

    public function scopeInProgress($query) {
        return $query->whereStatus(StudentStatusEnum::IN_PROGRESS->value);
    }

    public function scopeCompleted($query) {
        return $query->whereStatus(StudentStatusEnum::COMPLETED->value);
    }
}
