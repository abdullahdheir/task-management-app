<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'owner_id', 'team_id', 'name', 'slug', 'description',
        'color', 'icon', 'status', 'progress', 'budget',
        'start_date', 'due_date',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'due_date'   => 'date',
            'budget'     => 'decimal:2',
            'progress'   => 'integer',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_members')
            ->withPivot('role', 'job_title')
            ->withTimestamps();
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    // -------------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------------

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeForUser($query, User $user)
    {
        return $query->where('owner_id', $user->id)
            ->orWhereHas('members', fn($q) => $q->where('users.id', $user->id));
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    public function getCompletedTasksCountAttribute(): int
    {
        return $this->tasks()->where('is_completed', true)->count();
    }

    public function getTotalTasksCountAttribute(): int
    {
        return $this->tasks()->count();
    }

    public function recalculateProgress(): void
    {
        $total = $this->total_tasks_count;
        $this->progress = $total > 0
            ? (int) round(($this->completed_tasks_count / $total) * 100)
            : 0;
        $this->saveQuietly();
    }

    // -------------------------------------------------------------------------
    // Boot
    // -------------------------------------------------------------------------

    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            $project->slug ??= Str::slug($project->name);
        });
    }
}
