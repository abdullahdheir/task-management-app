<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'owner_id', 'status', 'started_at', 'completed_at'])]
class Task extends Model
{

    protected function casts(): array
    {
        return [
            'completed_at' => 'datetime',
            'started_at' => 'datetime',
            'status' => TaskStatus::class,
        ];
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
