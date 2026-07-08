<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'assignee_id', 'project_id', 'parent_id',
        'title', 'description', 'status', 'priority', 'category',
        'is_completed', 'completed_at', 'due_date', 'due_time', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_completed' => 'boolean',
            'completed_at' => 'datetime',
            'due_date'     => 'date',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'parent_id');
    }

    public function subtasks(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(TaskAttachment::class);
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

    public function scopeForUser($query, User $user)
    {
        return $query->where('user_id', $user->id)
            ->orWhere('assignee_id', $user->id);
    }

    public function scopePending($query)
    {
        return $query->where('is_completed', false);
    }

    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    public function scopeOverdue($query)
    {
        return $query->where('is_completed', false)
            ->whereNotNull('due_date')
            ->where('due_date', '<', now()->toDateString());
    }

    public function scopeDueToday($query)
    {
        return $query->whereDate('due_date', today());
    }

    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id');
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    public function getSubtaskProgressAttribute(): int
    {
        $total = $this->subtasks()->count();
        if ($total === 0) return 0;
        return (int) round(($this->subtasks()->where('is_completed', true)->count() / $total) * 100);
    }

    public function isOverdue(): bool
    {
        return !$this->is_completed
            && $this->due_date
            && $this->due_date->isPast();
    }

    public function markComplete(): void
    {
        $this->update([
            'is_completed' => true,
            'status'       => 'done',
            'completed_at' => now(),
        ]);

        $this->project?->recalculateProgress();
    }
}
