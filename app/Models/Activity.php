<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Activity extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id', 'subject_type', 'subject_id', 'action', 'meta'];

    protected $casts = [
        'meta'       => 'array',
        'created_at' => 'datetime',
    ];

    const UPDATED_AT = null;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    // -------------------------------------------------------------------------
    // Factory methods for common actions
    // -------------------------------------------------------------------------

    public static function log(User $user, Model $subject, string $action, array $meta = []): self
    {
        return self::create([
            'user_id'      => $user->id,
            'subject_type' => get_class($subject),
            'subject_id'   => $subject->id,
            'action'       => $action,
            'meta'         => $meta ?: null,
        ]);
    }
}
